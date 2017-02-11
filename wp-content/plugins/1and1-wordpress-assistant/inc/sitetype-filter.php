<?php
/** Do not allow direct access! */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Forbidden' );
}

/**
 * Class One_And_One_Sitetype_Filter
 * Retrieves Use Cases data from the sitetype-config.json
 */
class One_And_One_Sitetype_Filter {

	/**
	 * Check if the theme applies for this Use Case
	 *
	 * @param  string $sitetype
	 * @param  string $theme
	 * @return bool
	 */
	public static function is_sitetype_theme( $sitetype, $theme ) {
		$config = self::get_config();

		if ( ! $config ) {
			return false;
		}

		if ( isset( $config->any ) && isset( $config->any->themes ) && in_array( $theme, $config->any->themes ) ) {
			return true;
		}

		if ( isset( $config->$sitetype ) && isset( $config->$sitetype->themes ) && in_array( $theme, $config->$sitetype->themes ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Check if the plugin comes with this Use Case
	 *
	 * @param  string $sitetype
	 * @param  string $plugin
	 * @return bool
	 */
	public static function is_sitetype_plugin( $sitetype, $plugin ) {
		$config = self::get_config();

		if ( ! $config ) {
			return false;
		}

		if ( isset( $config->any ) && isset( $config->any->plugins ) && in_array( $plugin, $config->any->plugins ) ) {
			return true;
		}

		if ( isset( $config->$sitetype ) && isset( $config->$sitetype->plugins ) && in_array( $plugin, $config->$sitetype->plugins ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Get the list of Use Cases,
	 * each one with an array of associated data if $with_data is set to true.
	 * Data includes Use Case's:
	 * - title,
	 * - description,
	 * - image path.
	 *
	 * @param  bool $with_data
	 * @return array | bool
	 */
	public static function get_sitetypes($with_data = true) {
		$config = self::get_config();

		if ( ! $config ) {
			return false;
		}

		$sitetypes = array();
		$data_format = array(
			"headline"    => "",
			"description" => "",
			"image"       => ""
		);

		foreach ( $config as $key => $data ) {
			if ( ! in_array( $key, array( 'any', 'all' ) ) ) {

				if ( $with_data ) {
					$sitetypes[$key] =  array_intersect_key(
						( array ) $data,
						$data_format
					);

				} else {
					$sitetypes[] = $key;
				}
			}
		}

		return $sitetypes;
	}

	/**
	 * Filter the associated themes for a Use Case,
	 * among the list of selected themes
	 *
	 * @param  array $themes
	 * @param  string $sitetype
	 * @return array
	 */
	public static function get_filtered_themes( $themes, $sitetype ) {
		$config = self::get_config();

		if ( ! $config ) {
			return $themes;
		}

		$filtered_themes            = array();
		$included_themes            = array();
		$request_information_themes = array();

		if ( isset( $config->$sitetype->themes ) ) {
			foreach ( $config->$sitetype->themes as $theme_slug ) {
				foreach ( $themes as $theme ) {
					if ( $theme['id'] == $theme_slug ) {
						$filtered_themes[$theme_slug] = $theme;
						$included_themes[]            = $theme_slug;

						break;
					}
				}

				if ( ! in_array( $theme_slug, $included_themes ) ) {
					$request_information_themes[] = $theme_slug;
				}
			}
		}

		/** Get all information of provided themes from the official WP API but just if not already cached */
		$themes_cached       = array();
		$theme_meta_filename = One_And_One_Wizard::get_plugin_dir_path().'cache/theme-'.$sitetype.'-meta.txt';
		$updated             = false;

		if ( file_exists( $theme_meta_filename ) ) {
			$themes_cached = unserialize( file_get_contents( $theme_meta_filename ) );
		}

		if ( ! empty( $request_information_themes ) ) {
			foreach ( $request_information_themes as $request_information_theme ) {
				if ( ! empty( $themes_cached[$request_information_theme] ) ) {

					/** Handle special case: Theme was installed previously and uninstalled again but cache files were not refreshed */
					if ( ! file_exists( WP_CONTENT_DIR.'/themes/'.$request_information_theme.'/screenshot.png' ) ) {
						if ( ! empty( $themes_cached[$request_information_theme]['screenshot_url'] ) ) {
							$themes_cached[$request_information_theme]['screenshot'][0] = $themes_cached[$request_information_theme]['screenshot_url'];

							$filtered_themes[$request_information_theme] = $themes_cached[$request_information_theme];
							$included_themes[]                           = $request_information_theme;

							continue;
						}

						self::load_theme( $request_information_theme, $filtered_themes, $included_themes );
						$updated = true;

						continue;
					}

					$filtered_themes[$request_information_theme] = $themes_cached[$request_information_theme];
					$included_themes[]                           = $request_information_theme;

					continue;
				}

				self::load_theme( $request_information_theme, $filtered_themes, $included_themes );
				$updated = true;
			}
		}

		if ( isset( $config->any ) && isset( $config->any->themes ) ) {
			foreach ( $config->any->themes as $theme_slug ) {
				foreach ( $themes as $theme ) {
					if ( $theme['id'] == $theme_slug && ! in_array( $theme_slug, $included_themes ) ) {
						$filtered_themes[$theme_slug] = $theme;
					}
				}
			}
		}

		/** Save information to cache file to speed up loading performance */
		if ( ! empty( $updated ) ) {
			include_once One_And_One_Wizard::get_plugin_dir_path().'inc/cron-update-plugin-meta.php';
			$cron_class = new OneAndOne_Cron_Update_Plugin_Meta();
			$cron_class->update_theme_meta( $filtered_themes, array( $sitetype ) );
		}

		/** If active theme is not in list, then add it */
		$theme_active            = wp_get_theme();
		$theme_active_stylesheet = $theme_active->get_stylesheet();

		if ( ! in_array( $theme_active_stylesheet, $included_themes ) ) {
			self::load_theme( $theme_active_stylesheet, $filtered_themes, $included_themes );
		}

		/** Sort arrays - first entry must be the active theme */
		self::sort_theme_array( $filtered_themes, $theme_active_stylesheet, $filtered_themes[$theme_active_stylesheet] );

		return $filtered_themes;
	}

	/**
	 * Get the active theme's name
	 *
	 * @return string
	 */
	public static function get_active_theme_name() {
		$theme_name = ucwords( str_replace( array( '-', '_' ), ' ', get_template() ) );

		return $theme_name;
	}

	/**
	 * Get the Plugin category title for the current Use Case
	 *
	 * @param  string $sitetype
	 * @param  string $configkey
	 * @return string
	 */
	public static function get_headline_by_configkey( $sitetype, $configkey ) {
		$config = self::get_config();

		if ( $configkey == 'recommended_plugins' ) {
			$headline = '<h3>'.sprintf( __( 'Recommended plugins %s :', '1and1-wordpress-wizard' ), $sitetype ).'</h3>';
		} elseif ( $configkey == 'more_plugins' ) {
			$headline = '<h3>'.__( 'These plugins are worth a try as well:', '1and1-wordpress-wizard' ).'</h3>';
		} else {
			$headline = '';
		}

		if ( ! $config ) {
			return $headline;
		}

		if ( isset( $config->$sitetype->$configkey )
			&& is_object( $config->$sitetype->$configkey )
			&& $config->$sitetype->$configkey->headline
		) {
			$headline = '<h3>'._x( $config->$sitetype->$configkey->headline, 'json_plugins_section', '1and1-wordpress-wizard' ).'</h3>';
		}

		return $headline;
	}

	/**
	 * Get the Plugin category subtitle for the current Use Case
	 *
	 * @param  string $sitetype
	 * @param  string $configkey
	 * @return string
	 */
	public static function get_subline_by_configkey( $sitetype, $configkey ) {
		$config  = self::get_config();
		$subline = '';

		if ( ! $config ) {
			return $subline;
		}

		if ( isset( $config->$sitetype->$configkey )
			&& is_object( $config->$sitetype->$configkey )
			&& $config->$sitetype->$configkey->subline
		) {
			$subline = '<p>'._x( $config->$sitetype->$configkey->subline, 'json_plugins_section', '1and1-wordpress-wizard' ).'</p>';
		}

		return $subline;
	}

	/**
	 * Filter the associated plugins for a Use Case, in a given Plugin category
	 *
	 * @param  array $plugins
	 * @param  string $sitetype
	 * @param  string $configkey
	 * @return array
	 */
	public static function get_filtered_plugins_by_configkey( $plugins, $sitetype, $configkey ) {
		$config = self::get_config();

		if ( ! $config ) {
			return $plugins;
		}

		$filtered_plugins            = array();
		$slugs                       = array();
		$request_information_plugins = array();

		if ( isset( $config->$sitetype->$configkey ) ) {
			if ( is_array( $config->$sitetype->$configkey ) ) {
				foreach ( $config->$sitetype->$configkey as $slug ) {
					if ( ! in_array( $slug, $slugs ) ) {
						$slugs[] = $slug;
					}
				}
			} elseif ( is_object( $config->$sitetype->$configkey ) && isset( $config->$sitetype->$configkey->plugins ) ) {
				foreach ( $config->$sitetype->$configkey->plugins as $slug ) {
					if ( ! in_array( $slug, $slugs ) ) {
						$slugs[] = $slug;
					}
				}
			}
		}

		if ( isset( $config->any ) && isset( $config->any->$configkey ) ) {
			if ( is_array( $config->any->$configkey ) ) {
				foreach ( $config->any->$configkey as $slug ) {
					if ( ! in_array( $slug, $slugs ) ) {
						$slugs[] = $slug;
					}
				}
			} elseif ( is_object( $config->any->$configkey ) && isset( $config->any->$configkey->plugins ) ) {
				foreach ( $config->any->$configkey->plugins as $slug ) {
					if ( ! in_array( $slug, $slugs ) ) {
						$slugs[] = $slug;
					}
				}
			}
		}

		foreach ( $slugs as $slug ) {
			foreach ( $plugins as $plugin ) {
				if ( $plugin->slug == $slug ) {
					$filtered_plugins[] = $plugin;
					$plugin_selected    = true;
					break;
				}
			}

			if ( empty( $plugin_selected ) ) {
				$request_information_plugins[] = $slug;
			}

			$plugin_selected = false;
		}

		/** Get all information of provided plugins from the official WP API */
		if ( ! empty( $request_information_plugins ) ) {
			require_once( ABSPATH.'/wp-admin/includes/plugin-install.php' );
			foreach ( $request_information_plugins as $request_information_plugin ) {
				$filtered_plugins[] = plugins_api( 'plugin_information', array( 'slug' => $request_information_plugin, 'fields' => array( 'icons' => true, 'short_description' => true ) ) );
			}
		}

		return $filtered_plugins;
	}

	/**
	 * Get all associated plugins for a Use Case
	 *
	 * @param  string $sitetype
	 * @return array
	 */
	public static function get_plugins_by_sitetype( $sitetype ) {
		$config      = self::get_config();
		$plugins_all = array();

		if ( ! empty( $config->$sitetype->recommended_plugins->plugins ) ) {
			foreach ( $config->$sitetype->recommended_plugins->plugins as $recommended_plugin ) {
				$plugins_all[] = $recommended_plugin;
			}
		}

		if ( ! empty( $config->$sitetype->more_plugins->plugins ) ) {
			foreach ( $config->$sitetype->more_plugins->plugins as $more_plugin ) {
				$plugins_all[] = $more_plugin;
			}
		}

		if ( ! empty( $config->$sitetype->category_plugins ) ) {
			foreach ( $config->$sitetype->category_plugins as $category_plugins ) {
				if ( ! empty ( $category_plugins->plugins ) ) {
					foreach ( $category_plugins->plugins as $category_plugin ) {
						$plugins_all[] = $category_plugin;
					}
				}
			}
		}

		return $plugins_all;
	}

	/**
	 * Get all categorized plugins for a Use Case
	 *
	 * @param  array $plugins
	 * @param  string $sitetype
	 * @return array
	 */
	public static function get_filtered_category_plugins( $plugins, $sitetype ) {
		$config = self::get_config();

		if ( ! $config ) {
			return array();
		}

		$filtered_plugins = array();
		$category_slugs   = array();

		if ( isset( $config->$sitetype->category_plugins ) ) {
			foreach ( $config->$sitetype->category_plugins as $category ) {
				$request_information_plugins           = array();
				$category_slugs[$category->headline]   = array();
				$filtered_plugins[$category->headline] = array(
					'headline' => $category->headline,
					'subline'  => isset( $category->subline ) ? $category->subline : '',
					'plugins'  => array()
				);

				foreach ( $category->plugins as $slug ) {
					$plugin_selected = false;
					foreach ( $plugins as $plugin ) {
						if ( $plugin->slug == $slug ) {
							$filtered_plugins[$category->headline]['plugins'][] = $plugin;
							$category_slugs[$category->headline][]              = $slug;
							$plugin_selected                                    = true;
						}
					}

					if ( empty( $plugin_selected ) ) {
						$request_information_plugins[] = $slug;
					}
				}

				if ( ! empty( $request_information_plugins ) ) {
					require_once( ABSPATH.'/wp-admin/includes/plugin-install.php' );
					foreach ( $request_information_plugins as $request_information_plugin ) {
						$filtered_plugins[$category->headline]['plugins'][] = plugins_api( 'plugin_information', array( 'slug' => $request_information_plugin, 'fields' => array( 'icons' => true, 'short_description' => true ) ) );;
						$category_slugs[$category->headline][] = $request_information_plugin;
					}
				}
			}
		}

		if ( isset( $config->any ) && isset( $config->any->category_plugins ) ) {
			foreach ( $config->any->category_plugins as $category ) {

				if ( ! isset( $category_slugs[$category->headline] ) ) {
					$category_slugs[$category->headline] = array();
				}

				if ( ! isset( $filtered_plugins[$category->headline] ) ) {
					$filtered_plugins[$category->headline] = array(
						'headline' => $category->headline,
						'subline'  => isset( $category->subline ) ? $category->subline : '',
						'plugins'  => array()
					);
				}

				foreach ( $category->plugins as $slug ) {
					foreach ( $plugins as $plugin ) {
						if ( $plugin->slug == $slug && ! in_array( $slug, $category_slugs[$category->headline] ) ) {
							$filtered_plugins[$category->headline]['plugins'][] = $plugin;
						}
					}
				}
			}
		}

		return $filtered_plugins;
	}

	/**
	 * Retrieve the configuration from the WP transient
	 * https://codex.wordpress.org/Transients_API
	 *
	 * @return mixed
	 */
	public static function get_config() {
		$config = get_transient( 'one_and_one_sitetype_config' );

		if ( ! $config || isset( $_GET['refresh_sitetype_config'] ) ) {
			$json = file_get_contents( One_And_One_Wizard::get_plugin_dir_path().'sitetype-config.json' );
			if ( $json ) {
				$config = json_decode( $json );
				set_transient( 'one_and_one_sitetype_config', $config, 300 );

				return $config;
			}

			return false;
		}

		return $config;
	}

	/**
	 * Sort the array of themes, active theme first
	 *
	 * @param array $theme_array
	 * @param string $theme_active_stylesheet
	 * @param object $theme_object
	 */
	private static function sort_theme_array( &$theme_array, $theme_active_stylesheet, $theme_object ) {
		if ( ! empty( $theme_array[$theme_active_stylesheet] ) ) {
			unset( $theme_array[$theme_active_stylesheet] );
		}

		$theme_array                           = array_reverse( $theme_array, true );
		$theme_array[$theme_active_stylesheet] = $theme_object;

		/** Set active parameter if not set yet, needed in the output for the correct CSS class */
		if ( empty( $theme_array[$theme_active_stylesheet]['active'] ) ) {
			$theme_array[$theme_active_stylesheet]['active'] = true;
		}

		$theme_array = array_reverse( $theme_array, true );
	}

	/**
	 * Retrieve a theme through the WP API and save it in the $filtered_themes
	 *
	 * @param $slug
	 * @param $filtered_themes
	 * @param $included_themes
	 */
	private static function load_theme( $slug, &$filtered_themes, &$included_themes ) {
		$api_request = wp_remote_get( 'https://api.wordpress.org/themes/info/1.1/?action=theme_information&request[slug]='.$slug );

		if ( $api_request['response']['code'] == 200 AND ! empty( $api_request['body'] ) ) {
			$theme_api_request       = json_decode( $api_request['body'], true );
			$theme_api_request['id'] = $theme_api_request['slug'];

			if ( ! empty( $theme_api_request['screenshot_url'] ) ) {
				$theme_api_request['screenshot'] = array( $theme_api_request['screenshot_url'] );
			}

			if ( ! empty( $theme_api_request['sections']['description'] ) ) {
				$theme_api_request['description'] = $theme_api_request['sections']['description'];
			}

			$filtered_themes[$theme_api_request['slug']] = $theme_api_request;
			$included_themes[]                           = $theme_api_request['slug'];
		}
	}
}
