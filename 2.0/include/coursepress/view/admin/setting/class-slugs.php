<?php

require_once dirname( __FILE__ ) . '/class-settings.php';

class CoursePress_View_Admin_Setting_Slugs extends CoursePress_View_Admin_Setting_Setting {

	public static function init() {

		add_action( 'coursepress_settings_process_slugs', array( __CLASS__, 'process_form' ), 10, 2 );
		add_filter( 'coursepress_settings_render_tab_slugs', array( __CLASS__, 'return_content' ), 10, 3 );
		add_filter( 'coursepress_settings_tabs', array( __CLASS__, 'add_tabs' ) );

	}

	public static function add_tabs( $tabs ) {

		self::$slug = 'slugs';
		$tabs[ self::$slug ] = array(
			'title' => __( 'Slugs', 'cp' ),
			'description' => sprintf( __( 'A slug is a few words that describe a post or a page. Slugs are usually a URL friendly version of the post title ( which has been automatically generated by WordPress ), but a slug can be anything you like. Slugs are meant to be used with %s as they help describe what the content at the URL is. Post slug substitutes the %s placeholder in a custom permalink structure.', 'cp' ), '<a href="options-permalink.php">permalinks</a>', '<strong>"%posttitle%"</strong>' ),
			'order' => 3,
		);

		return $tabs;

	}

	public static function return_content( $content, $slug, $tab ) {

		$my_course_prefix = __( 'my-course', 'cp' );
		$my_course_prefix = sanitize_text_field( CoursePress_Core::get_setting( 'slugs/course', 'courses' ) ) . '/'. $my_course_prefix;

		$home_url = trailingslashit( esc_url( home_url() ) );
		$my_course_url = $home_url . trailingslashit( esc_html( $my_course_prefix ) );

		$content = '';

		$content .= self::page_start( $slug, $tab );
		$content .= self::table_start();

		$content .= self::row(
			__( 'Courses Slug', 'cp' ),
			esc_html( $home_url ) . '&nbsp;<input type="text" name="coursepress_settings[slugs][course]" id="course_slug" value="' . esc_attr( CoursePress_Core::get_setting( 'slugs/course', 'courses' ) ).'" />&nbsp;/',
			esc_html__( 'Your course URL will look like: ', 'cp' ) . esc_html( $home_url ) . esc_html( CoursePress_Core::get_setting( 'slugs/course', 'courses' ) ) . esc_html__( '/my-course/', 'cp' )
		);

		$content .= self::row(
			__( 'Course Category Slug', 'cp' ),
			esc_html( $home_url . trailingslashit( esc_html( CoursePress_Core::get_setting( 'slugs/course', 'courses' ) ) ) ) . '&nbsp;<input type="text" name="coursepress_settings[slugs][category]" id="category_slug" value="' . esc_attr( CoursePress_Core::get_setting( 'slugs/category', 'course_category' ) ) . '" />&nbsp;/',
			esc_html__( 'Your course category URL will look like: ', 'cp' ) . $home_url . esc_html( CoursePress_Core::get_setting( 'slugs/course', 'courses' ) . '/' . CoursePress_Core::get_setting( 'slugs/category', 'course_category' ) ) . esc_html__( '/your-category/', 'cp' )
		);

		$content .= self::row(
			__( 'Units Slug', 'cp' ),
			$my_course_url . '&nbsp;<input type="text" name="coursepress_settings[slugs][units]" id="units_slug" value="' . esc_attr( CoursePress_Core::get_setting( 'slugs/units', 'units' ) ) . '" />&nbsp;/'
		);

		$content .= self::row(
			__( 'Course Notifications Slug', 'cp' ),
			$my_course_url . '&nbsp;<input type="text" name="coursepress_settings[slugs][notifications]" id="notifications_slug" value="' . esc_attr( CoursePress_Core::get_setting( 'slugs/notifications', 'notifications' ) ) . '" />&nbsp;/'
		);

		$content .= self::row(
			__( 'Course Discussions Slug', 'cp' ),
			$my_course_url . '&nbsp;<input type="text" name="coursepress_settings[slugs][discussions]" id="discussions_slug" value="' . esc_attr( CoursePress_Core::get_setting( 'slugs/discussions', 'discussion' ) ) . '" />&nbsp;/'
		);

		$content .= self::row(
			__( 'Course New Discussion Slug', 'cp' ),
			$my_course_url . trailingslashit( esc_attr( CoursePress_Core::get_setting( 'slugs/discussions', 'discussion' ) ) ) .'&nbsp;<input type="text" name="coursepress_settings[slugs][discussions_new]" id="discussions_new_slug" value="' . esc_attr( CoursePress_Core::get_setting( 'slugs/discussions_new', 'add_new_discussion' ) ) . '" />&nbsp;/'
		);

		$content .= self::row(
			__( 'Course Grades Slug', 'cp' ),
			$my_course_url . '&nbsp;<input type="text" name="coursepress_settings[slugs][grades]" id="grades_slug" value="' . esc_attr( CoursePress_Core::get_setting( 'slugs/grades', 'grades' ) ) . '" />&nbsp;/'
		);

		$content .= self::row(
			__( 'Course Workbook Slug', 'cp' ),
			trailingslashit( esc_url( home_url() ) ) . trailingslashit( esc_html( $my_course_prefix ) ) . '&nbsp;<input type="text" name="coursepress_settings[slugs][workbook]" id="workbook_slug" value="' . esc_attr( CoursePress_Core::get_setting( 'slugs/workbook', 'workbook' ) ) . '" />&nbsp;/'
		);

		$content .= self::row(
			__( 'Enrollment Process Slug', 'cp' ),
			trailingslashit( esc_url( home_url() ) ) . '&nbsp;<input type="text" name="coursepress_settings[slugs][enrollment]" id="enrollment_slug" value="' . esc_attr( CoursePress_Core::get_setting( 'slugs/enrollment', 'enrollment_process' ) ) . '" />&nbsp;/'
		);

		$content .= self::row(
			__( 'Instructor Profile Slug', 'cp' ),
			trailingslashit( esc_url( home_url() ) ) . '&nbsp;<input type="text" name="coursepress_settings[slugs][instructor_profile]" id="instructor_profile_slug" value="' . esc_attr( CoursePress_Core::get_setting( 'slugs/instructor_profile', 'instructor' ) ) . '" />&nbsp;/'
		);

		$content .= self::table_end();
		return $content;

	}
}