scnShortcodeMeta={
	attributes:[
		{
			label:"Percentage",
			id:"percentage",
            help:"Use this if you dont want striped. Ignore success, warning, danger bars ",
			isRequired:true
		},
        {
		label:"Type",
		id:"type",
		help:"", 
		controlType:"select-control", 
		selectValues:['default','stacked']
   		 },
   		{
   		label:"Title",
   		id:"title",
   		help:"Tilte on progressbar"
   		},
         {
		label:"Striped?",
		id:"striped",
		help:"", 
		controlType:"select-control", 
		selectValues:['yes','no']
   		 },
         {
		label:"Animated?",
		id:"animated",
		help:"", 
		controlType:"select-control", 
		selectValues:['yes','no']
   		 },
         {
		label:"Success Bar",
		id:"success",
		
   		 },
         {
		label:"Warning Bar",
		id:"warning",
		
   		 },
         {
		label:"Danger Bar",
		id:"danger",
		
   		 },
         {
		label:"Style",
		id:"style",
		help:"Set the style if you dont use stacked type", 
		controlType:"select-control", 
		selectValues:['default','success', 'error', 'info']
   		 },
        
         
		],
		
		shortcode:"progressbar"
		
};