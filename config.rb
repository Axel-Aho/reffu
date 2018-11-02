add_import_path "../../plugins/gwwp-grid/sass/"
http_path = "."
css_dir = "." # Directory for generated CSS-files 
sass_dir = "sass" # Directory for SASS-files
images_dir = "images" # Default directory for image files
javascripts_dir = "js" # Default directory for JS files
font_dir = "fonts" # Default directory for font files


### Development environment settings. Combines CSS-files but leaves file formatting and adds additional comments
#environment = :development
#output_style = :expanded
sass_options = { :sourcemap => true }

### Production environment settings. Compressses CSS-files to smallest possible form and removes obsolete comments
environment = :production
output_style = :compressed
