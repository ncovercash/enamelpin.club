<?php
return [
	"target_php_version" => "7.4",

	"strict_method_checking" => true,
	"strict_object_checking" => true,
	"strict_param_checking" => true,
	"strict_property_checking" => true,
	"strict_return_checking" => true,
	"backward_compatibility_checks" => true,
	"unused_variable_detection" => true,
	"redundant_condition_detection" => true,
	"assume_real_types_for_internal_functions" => true,
	"dead_code_detection" => true,
	"progress_bar" => true,
	"print_memory_usage_summary" => true,
	"scalar_implicit_cast" => true,
	"quick_mode" => true,

	"suppress_issue_types" => [
		"PhanAbstractStaticMethodCallInStatic",
		"PhanUnreferencedProtectedMethod",
		"PhanUnreferencedPublicClassConstant",
		"PhanUnreferencedPublicMethod",
		"PhanUnreferencedUseNormal",
		"PhanUnusedVariableCaughtException",
		"PhanPluginUseReturnValueInternalKnown",
		"PhanTypeInstantiateAbstractStatic",
		"PhanUnreferencedClass",
		"PhanUnreferencedConstant",
	],

	"processes" => 1,

	"plugins" => [
		"AlwaysReturnPlugin",
		"DollarDollarPlugin",
		"DuplicateArrayKeyPlugin",
		"DuplicateExpressionPlugin",
		"EmptyStatementListPlugin",
		"LoopVariableReusePlugin",
		"PregRegexCheckerPlugin",
		"PrintfCheckerPlugin",
		"SleepCheckerPlugin",
		"StrictComparisonPlugin",
		"UnreachableCodePlugin",
		"UseReturnValuePlugin",
	],

	"directory_list" => ["./src/php", "./www", "./src/html"],
	"exclude_analysis_directory_list" => ["./src/php/vendor"],
];
