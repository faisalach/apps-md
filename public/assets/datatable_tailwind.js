$.extend( DataTable.ext.classes, {
	"sTable": "lg:col-span-2 !w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400",
	"sNoFooter": "",

	/* Paging buttons */
	"sPageButton": "flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white",
	"sPageButtonActive": "flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white",
	"sPageButtonDisabled": "disabled",

	/* Striping classes */
	"sStripeOdd": "bg-white",
	"sStripeEven": "bg-gray-100",

	/* Empty row */
	"sRowEmpty": "text-center p-5",

	/* Features */
	"sWrapper": "grid lg:grid-cols-2 gap-2 w-full",
	"sFilter": "lg:ml-auto datatable_filter mt-1",
	"sInfo": "text-sm mt-2",
	"sPaging": "inline-flex -space-x-px text-sm lg:ml-auto ", /* Note that the type is postfixed */
	"sLength": "datatable_length mt-1",
	"sProcessing": "text-center p-5 absolute z-10 w-full top-20",

	/* Sorting */
	"sSortAsc": "sorting_asc",
	"sSortDesc": "sorting_desc",
	"sSortable": "relative sorting", /* Sortable in both directions */
	"sSortableAsc": "sorting_desc_disabled",
	"sSortableDesc": "sorting_asc_disabled",
	"sSortableNone": "sorting_disabled",
	"sSortColumn": "sorting_", /* Note that an int is postfixed for the sorting order */

	/* Filtering */
	"sFilterInput": "px-2 py-1 rounded-lg ml-2 border-gray-300",

	/* Page length */
	"sLengthSelect": "px-2 py-1 rounded-lg ml-2 border-gray-300",

	/* Scrolling */
	"sScrollWrapper": "dataTables_scroll",
	"sScrollHead": "dataTables_scrollHead",
	"sScrollHeadInner": "dataTables_scrollHeadInner",
	"sScrollBody": "dataTables_scrollBody",
	"sScrollFoot": "dataTables_scrollFoot",
	"sScrollFootInner": "dataTables_scrollFootInner",

	/* Misc */
	"sHeaderTH": "",
	"sFooterTH": "",

	// Deprecated
	"sSortJUIAsc": "asdsa",
	"sSortJUIDesc": "",
	"sSortJUI": "",
	"sSortJUIAscAllowed": "",
	"sSortJUIDescAllowed": "",
	"sSortJUIWrapper": "",
	"sSortIcon": "",
	"sJUIHeader": "",
	"sJUIFooter": ""
} );