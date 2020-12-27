# convert argument list to comma-separated string
OLDIFS=$IFS
IFS=","
CSV_FILES=$*
IFS=$OLDIFS

# run task
./src/php/vendor/bin/phan -d . -k ./src/php/.phan/config.php --include-analysis-file-list "${CSV_FILES}"
