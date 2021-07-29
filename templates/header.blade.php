<!doctype html>
<html {!! get_language_attributes() !!}>
<head>
    <meta charset="{{ get_bloginfo('charset') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
	@wp_head()
</head>
<body @body_class()>
@wp_body_open()