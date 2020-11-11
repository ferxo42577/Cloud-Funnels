/*
Copyright 2017 Ziadin Givan

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

   http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

https://github.com/givanz/Vvvebjs
*/

bgcolorClasses = ["bg-primary", "bg-secondary", "bg-success", "bg-danger", "bg-warning", "bg-info", "bg-light", "bg-dark", "bg-white"]

bgcolorSelectOptions = 
[{
	value: "Default",
	text: ""
}, 
{
	value: "bg-primary",
	text: t("Primary")
}, {
	value: "bg-secondary",
	text: t("Secondary")
}, {
	value: "bg-success",
	text: t("Success")
}, {
	value: "bg-danger",
	text: t("Danger")
}, {
	value: "bg-warning",
	text: t("Warning")
}, {
	value: "bg-info",
	text: t("Info")
}, {
	value: "bg-light",
	text: t("Light")
}, {
	value: "bg-dark",
	text: t("Dark")
}, {
	value: "bg-white",
	text: t("White")
}];

function changeNodeName(node, newNodeName)
{
	var newNode;
	newNode = document.createElement(newNodeName);
	attributes = node.get(0).attributes;
	
	for (i = 0, len = attributes.length; i < len; i++) {
		newNode.setAttribute(attributes[i].nodeName, attributes[i].nodeValue);
	}

	$(newNode).append($(node).contents());
	$(node).replaceWith(newNode);
	
	return newNode;
}

Vvveb.ComponentsGroup['General Components (Bootstrap-4)'] =
["html/container", "html/gridrow", "html/button", "html/buttongroup", "html/buttontoolbar", "html/heading", "html/image", "html/jumbotron", "html/alert", "html/card", "html/listgroup", "html/hr", "html/taglabel", "html/badge", "html/progress", "html/navbar", "html/breadcrumbs", "html/pagination", "html/form", "html/textinput", "html/textareainput", "html/selectinput", "html/fileinput", "html/checkbox", "html/radiobutton", "html/table", "html/paragraph", "html/link", "html/video"];


var base_sort = 100;//start sorting for base component from 100 to allow extended properties to be first
var style_section = 'style';

Vvveb.Components.add("_base", {
    name: t("Element"),
	properties: [{
        key: "element_header",
        inputtype: SectionInput,
        name:false,
        sort:base_sort++,
        data: {header:t("General")},
    }, {
        name: t("Id"),
        key: "id",
        htmlAttr: "id",
        sort: base_sort++,
        inline:true,
        col:6,
        inputtype: TextInput
    }, {
        name: t("Class"),
        key: "class",
        htmlAttr: "class",
        sort: base_sort++,
        inline:true,
        col:6,
        inputtype: TextInput
    },
    /*
    inputtype: SelectInput,
        validValues: ["block", "inline", "inline-block", "none"],
        data: {
            options: [{
                value: "block",
                text: "Block"
            }, {
    */
    {
        name: t("Input Name"),
        key: "name",
        htmlAttr: "name",
        sort: base_sort++,
        inline:true,
        col:6,
        inputtype: SelectInput,
        data: (function(options){
            let arr=[]
            try{
                options.forEach((op)=>{
                    arr.push({
                        value: op,
                        text: op
                    });
                });
            }catch(err){console.log(err);}
            return {options:arr};
        })(cf_global_page_inputs),
    },
    {
        name: t("CF-Loop"),
        key: "cf-loop",
        htmlAttr: "do-cf-loop",
        sort: base_sort++,
        inline:true,
        col:6,
        inputtype: SelectInput,
        data:{options: [{value:null,text:t("None")},{value:"members",text:t("Members")},{value:"products",text:t("Products")}]}
    },
    {
        name: t("Disable"),
        key: "vvdodisabled",
        htmlAttr: "disabled",
        sort: base_sort++,
        inline:true,
        col:6,
        inputtype: SelectInput,
        data:{options: [{value:"disabled",text:t("yes")},{value:null,text:t("No")}]}
    },
    {
        name: t("Required"),
        key: "vvisrequired",
        htmlAttr: "required",
        sort: base_sort++,
        inline:true,
        col:6,
        inputtype: SelectInput,
        data:{options: [{value:"required",text:t("yes")},{value:null,text:t("No")}]}
    },
    {
        key: "element_header_linking",
        inputtype: SectionInput,
        name:false,
        sort:base_sort++,
        data: {header:"Auto Linking"},
    },
    {
        name: t("Create Link"),
        key: "vvautolink",
        htmlAttr: "data-autolink",
        sort: base_sort++,
        inline:true,
        col:6,
        inputtype: SelectInput,
        data:{options: [{value:"1",text:t("Yes")},{value:null,text:t("No")}]}
    },
    {
        name: t("Open In"),
        key: "vvautolinktarget",
        htmlAttr: "data-autolink-target",
        sort: base_sort++,
        inline:true,
        col:6,
        inputtype: SelectInput,
        data:{options: [{value:null,text:t("Same Tab")},{value:"_BLANK",text:t("New Tab")}]}
    },
    {
        name: t("URL (Skip if you are making OTO link)"),
        key: "vvautolinkurl",
        htmlAttr: "data-autolink-url",
        sort: base_sort++,
        inline:true,
        col:12,
        inputtype: TextInput,
    },
    {
        name: t("OTO LINK"),
        key: "vvautolinkoto",
        htmlAttr: "data-autolink-oto",
        sort: base_sort++,
        inline: true,
        col: 12,
        inputtype: SelectInput,
        data:{options: [{value:null,text:t("No")},{value:"1",text:t("OTO Product Link")},{value:"2",text:t("OTO Exit Link")},{value:"-1",text:t("OTO Product Removal Link (Checkout Page)")}]}
    },
    {
        name: t("OTO Product ID"),
        key: "vvautolinkotoproduct",
        htmlAttr: "data-autolink-oto-product",
        sort: base_sort++,
        inline:true,
        col:12,
        inputtype: TextInput,
    },
    {
        name: t("Next OTO Link"),
        key: "vvautolinkotonext",
        htmlAttr: "data-autolink-oto-next",
        sort: base_sort++,
        inline:true,
        col:12,
        inputtype: TextInput,
    }
   ],
   onChange: function(node,property,value){
       //alert(property.key);
       if(property.key=="cf-loop")
       {
           let html=$(node).html();
           try{
            $(node).removeAttr('cf-loop');
           }catch(err){console.log(err);}
           
           html=html.replace(/({products}|{members})/ig,"");
           html=html.replace(/({\/products}|{\/members})/ig,"");

           html=html.replace(/{members}/ig,"");
           html=html.replace(/{\/members}/ig,"");

           if(value=="products")
           {
            html =`{products}${html}{/products}`;
           }
           else if(value=="members")
           {
            html =`{members}${html}{/members}`;
           }
           $(node).html(html);
       }
       if(property.key=="vvautolink" || (property.key=="vvautolinkoto" && ['1','2'].indexOf(value)>-1))
       {
           try
           {
                if(value=='1')
                {
                    $(node).css({'cursor':'pointer'});
                    //$(node).attr('onclick',`cfAutoLinkAdder(this)`);
                }
                else if(property.key=="vvautolink")
                {
                    $(node).css({'cursor':''});
                    //$(node).removeAttr('onclick');
                }
           }
           catch(err)
           {console.log(err);}
       }
   }
});    

//display
Vvveb.Components.extend("_base", "_base", {
	 properties: [
     {
        key: "display_header",
        inputtype: SectionInput,
        name:false,
        sort: base_sort++,
		section: style_section,
        data: {header:t("Display")},
    }, {
        name: t("Display"),
        key: "display",
        htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: SelectInput,
        validValues: ["block", "inline", "inline-block", "none"],
        data: {
            options: [{
                value: "block",
                text: t("Block")
            }, {
                value: "inline",
                text: t("Inline")
            }, {
                value: "inline-block",
                text: t("Inline Block")
            }, {
                value: "none",
                text: t("none")
            }]
        }
    }, {
        name: t("Position"),
        key: "position",
        htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: SelectInput,
        validValues: ["static", "fixed", "relative", "absolute"],
        data: {
            options: [{
                value: "static",
                text: t("Static")
            }, {
                value: "fixed",
                text: t("Fixed")
            }, {
                value: "relative",
                text: t("Relative")
            }, {
                value: "absolute",
                text: t("Absolute")
            }]
        }
    }, {
        name: t("Top"),
        key: "top",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        parent:"",
        inputtype: CssUnitInput
	}, {
        name: t("Left"),
        key: "left",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        parent:"",
        inputtype: CssUnitInput
    }, {
        name: t("Bottom"),
        key: "bottom",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        parent:"",
        inputtype: CssUnitInput
	}, {
        name: t("Right"),
        key: "right",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        parent:"",
        inputtype: CssUnitInput
    },{
        name: t("Float"),
        key: "float",
        htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:12,
        inline:true,
        inputtype: RadioButtonInput,
        data: {
			extraclass:"btn-group-sm btn-group-fullwidth",
            options: [{
                value: "none",
                icon:"la la-close",
                //text: "None",
                title: t("None"),
                checked:true,
            }, {
                value: "left",
                //text: "Left",
                title: t("Left"),
                icon:"la la-align-left",
                checked:false,
            }, {
                value: "right",
                //text: "Right",
                title: t("Right"),
                icon:"la la-align-right",
                checked:false,
            }],
         }
	}, {
        name: t("Opacity"),
        key: "opacity",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:12,
		inline:true,
        parent:"",
        inputtype: RangeInput,
        data:{
			max: 1, //max zoom level
			min:0,
			step:0.1
       },
	}, {
        name: t("Background Color"),
        key: "background-color",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
		htmlAttr: "style",
        inputtype: ColorInput,
	}, {
        name: t("Text Color"),
        key: "color",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
		htmlAttr: "style",
        inputtype: ColorInput,
  	}]
});    

//Typography
Vvveb.Components.extend("_base", "_base", {
	 properties: [
     {
		key: "typography_header",
		inputtype: SectionInput,
		name:false,
		sort: base_sort++,
		section: style_section,
		data: {header:t("Typography")},
 
	}, {
        name: t("Font size"),
        key: "font-size",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
	}, {
        name: t("Font weight"),
        key: "font-weight",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: SelectInput,
        data: {
			options: [{
				value: "",
				text: t("Default")
			}, {	
				value: "100",
				text: t("Thin")
			}, {
				value: "200",
				text: t("Extra-Light")
			}, {
				value: "300",
				text: t("Light")
			}, {
				value: "400",
				text: t("Normal")
			}, {
				value: "500",
				text: t("Medium")
			}, {
				value: "600",
				text: t("Semi-Bold")
			}, {
				value: "700",
				text: t("Bold")
			}, {
				value: "800",
				text: t("Extra-Bold")
			}, {
				value: "900",
				text: t("Ultra-Bold")
			}],
		}
   }, {
        name: t("Font family"),
        key: "font-family",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:12,
		inline:true,
        inputtype: SelectInput,
        data: {
			options: [{
				value: "",
				text: t("Default")
			}, {
				value: "Arial, Helvetica, sans-serif",
				text: t("Arial")
			}, {
				value: 'Lucida Sans Unicode", "Lucida Grande", sans-serif',
				text: t('Lucida Grande')
			}, {
				value: 'Palatino Linotype", "Book Antiqua", Palatino, serif',
				text: t('Palatino Linotype')
			}, {
				value: '"Times New Roman", Times, serif',
				text: t('Times New Roman')
			}, {
				value: "Georgia, serif",
				text: t("Georgia, serif")
			}, {
				value: "Tahoma, Geneva, sans-serif",
				text: t("Tahoma")
			}, {
				value: 'Comic Sans MS, cursive, sans-serif',
				text: t('Comic Sans')
			}, {
				value: 'Verdana, Geneva, sans-serif',
				text: t('Verdana')
			}, {
				value: 'Impact, Charcoal, sans-serif',
				text: t('Impact')
			}, {
				value: 'Arial Black, Gadget, sans-serif',
				text: t('Arial Black')
			}, {
				value: 'Trebuchet MS, Helvetica, sans-serif',
				text: t('Trebuchet')
			}, {
				value: 'Courier New", Courier, monospace',
				text: t('Courier New", Courier, monospace')
			}, {
				value: 'Brush Script MT, sans-serif',
				text: t('Brush Script')
			}]
		}		
	}, {
        name: t("Text align"),
        key: "text-align",
        htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:12,
        inline:true,
        inputtype: RadioButtonInput,
        data: {
			extraclass:"btn-group-sm btn-group-fullwidth",
            options: [{
                value: "none",
                icon:"la la-close",
                //text: "None",
                title: t("None"),
                checked:true,
            }, {
                value: "left",
                //text: "Left",
                title: t("Left"),
                icon:"la la-align-left",
                checked:false,
            }, {
                value: "center",
                //text: "Center",
                title: t("Center"),
                icon:"la la-align-center",
                checked:false,
            }, {
                value: "right",
                //text: "Right",
                title: t("Right"),
                icon:"la la-align-right",
                checked:false,
            }, {
                value: "justify",
                //text: "justify",
                title: t("Justify"),
                icon:"la la-align-justify",
                checked:false,
            }],
        },
	}, {
        name: t("Line height"),
        key: "line-height",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
	}, {
        name: t("Letter spacing"),
        key: "letter-spacing",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
	}, {
        name: t("Text decoration"),
        key: "text-decoration-line",
        htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:12,
        inline:true,
        inputtype: RadioButtonInput,
        data: {
			extraclass:"btn-group-sm btn-group-fullwidth",
            options: [{
                value: "none",
                icon:"la la-close",
                //text: "None",
                title: t("None"),
                checked:true,
            }, {
                value: "underline",
                //text: "Left",
                title: t("underline"),
                icon:"la la-long-arrow-down",
                checked:false,
            }, {
                value: "overline",
                //text: "Right",
                title: t("overline"),
                icon:"la la-long-arrow-up",
                checked:false,
            }, {
                value: "line-through",
                //text: "Right",
                title: t("Line Through"),
                icon:"la la-strikethrough",
                checked:false,
            }, {
                value: "underline overline",
                //text: "justify",
                title: t("Underline Overline"),
                icon:"la la-arrows-v",
                checked:false,
            }],
        },
	}, {
        name: t("Decoration Color"),
        key: "text-decoration-color",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
		htmlAttr: "style",
        inputtype: ColorInput,
	}, {
        name: t("Decoration style"),
        key: "text-decoration-style",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: SelectInput,
        data: {
			options: [{
				value: "",
				text: t("Default")
			}, {	
				value: "solid",
				text: t("Solid")
			}, {
				value: "wavy",
				text: t("Wavy")
			}, {
				value: "dotted",
				text: t("Dotted")
			}, {
				value: "dashed",
				text: t("Dashed")
			}, {
				value: "double",
				text: t("Double")
			}],
		}
  }]
})
    
//Size
Vvveb.Components.extend("_base", "_base", {
	 properties: [{
		key: "size_header",
		inputtype: SectionInput,
		name:false,
		sort: base_sort++,
		section: style_section,
		data: {header:"Size", expanded:false},
	}, {
        name: t("Width"),
        key: "width",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
	}, {
        name: t("Height"),
        key: "height",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
	}, {
        name: t("Min Width"),
        key: "min-width",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
	}, {
        name: t("Min Height"),
        key: "min-height",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
	}, {
        name: t("Max Width"),
        key: "max-width",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
	}, {
        name: t("Max Height"),
        key: "max-height",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
    }]
});

//Margin
Vvveb.Components.extend("_base", "_base", {
	 properties: [{
		key: "margins_header",
		inputtype: SectionInput,
		name:false,
		sort: base_sort++,
		section: style_section,
		data: {header:t("Margin"), expanded:false},
	}, {
        name: t("Top"),
        key: "margin-top",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
	}, {
        name: t("Right"),
        key: "margin-right",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
    }, {
        name: t("Bottom"),
        key: "margin-bottom",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
    }, {
        name: t("Left"),
        key: "margin-left",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
    }]
});

//Padding
Vvveb.Components.extend("_base", "_base", {
	 properties: [{
		key: "paddings_header",
		inputtype: SectionInput,
		name:false,
		sort: base_sort++,
		section: style_section,
		data: {header:t("Padding"), expanded:false},
	}, {
        name: t("Top"),
        key: "padding-top",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
	}, {
        name: t("Right"),
        key: "padding-right",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
    }, {
        name: t("Bottom"),
        key: "padding-bottom",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
    }, {
        name: t("Left"),
        key: "padding-left",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
    }]
});


//Border
Vvveb.Components.extend("_base", "_base", {
	 properties: [{
		key: "border_header",
		inputtype: SectionInput,
		name:false,
		sort: base_sort++,
		section: style_section,
		data: {header:t("Border"), expanded:false},
	 }, {        
        name: t("Style"),
        key: "border-style",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:12,
		inline:true,
        inputtype: SelectInput,
        data: {
			options: [{
				value: "",
				text: t("Default")
			}, {	
				value: "solid",
				text: t("Solid")
			}, {
				value: "dotted",
				text: t("Dotted")
			}, {
				value: "dashed",
				text: t("Dashed")
			}],
		}
	}, {
        name: t("Width"),
        key: "border-width",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
   	}, {
        name: t("Color"),
        key: "border-color",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
		htmlAttr: "style",
        inputtype: ColorInput,
	}]
});    



//Border radius
Vvveb.Components.extend("_base", "_base", {
	 properties: [{
		key: "border_radius_header",
		inputtype: SectionInput,
		name:false,
		sort: base_sort++,
		section: style_section,
		data: {header:t("Border radius"), expanded:false},
	}, {
        name: t("Top Left"),
        key: "border-top-left-radius",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
	}, {
        name: t("Top Right"),
        key: "border-top-right-radius",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
    }, {
        name: t("Bottom Left"),
        key: "border-bottom-left-radius",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
    }, {
        name: t("Bottom Right"),
        key: "border-bottom-right-radius",
		htmlAttr: "style",
        sort: base_sort++,
		section: style_section,
        col:6,
		inline:true,
        inputtype: CssUnitInput
    }]
});

//Background image
Vvveb.Components.extend("_base", "_base", {
	 properties: [{
		key: "background_image_header",
		inputtype: SectionInput,
		name:false,
		sort: base_sort++,
		section: style_section,
		data: {header:t("Background Image"), expanded:false},
	 },{
        name: t("Image"),
        key: "Image",
        sort: base_sort++,
		section: style_section,
		//htmlAttr: "style",
        inputtype: ImageInput,
        
        init: function(node) {
			var image = $(node).css("background-image").replace(/^url\(['"]?(.+)['"]?\)/, '$1');
			return image;
        },

		onChange: function(node, value) {
			
			$(node).css('background-image', 'url(\'' + value + '\')');
			
			return node;
		}        

       },
       {
        name: t("&nbsp;&nbsp;"),
        key: "bgcfMediaBgImg",
        inputtype: ButtonInput,
        data: {text: t("Import Media")},
        sort: base_sort++,
        onChange: function(node)
        {
            doEditorMediaOpen(
                function(data){
                    $(node).css('background-image', `url('${data}')`);
                }
            );
            return node;
        }
    }
       ,{
        name: t("Repeat"),
        key: "background-repeat",
        sort: base_sort++,
		section: style_section,
		htmlAttr: "style",
        inputtype: SelectInput,
        data: {
			options: [{
				value: "",
				text: t("Default")
			}, {	
				value: "repeat-x",
				text: t("repeat-x")
			}, {
				value: "repeat-y",
				text: t("repeat-y")
			}, {
				value: "no-repeat",
				text: t("no-repeat")
			}],
		}
   	}, {
        name: "Size",
        key: "background-size",
        sort: base_sort++,
		section: style_section,
		htmlAttr: "style",
        inputtype: SelectInput,
        data: {
			options: [{
				value: "",
				text: t("Default")
			}, {	
				value: "contain",
				text: t("contain")
			}, {
				value: "cover",
				text: t("cover")
			}],
		}
   	}, {
        name: t("Position x"),
        key: "background-position-x",
        sort: base_sort++,
		section: style_section,
		htmlAttr: "style",
        col:6,
		inline:true,
		inputtype: SelectInput,
        data: {
			options: [{
				value: "",
				text: t("Default")
			}, {	
				value: "center",
				text: t("center")
			}, {	
				value: "right",
				text: t("right")
			}, {
				value: "left",
				text: t("left")
			}],
		}
   	}, {
        name: t("Position y"),
        key: "background-position-y",
        sort: base_sort++,
		section: style_section,
		htmlAttr: "style",
        col:6,
		inline:true,
		inputtype: SelectInput,
        data: {
			options: [{
				value: "",
				text: t("Default")
			}, {	
				value: "center",
				text: t("center")
			}, {	
				value: "top",
				text: t("top")
			}, {
				value: "bottom",
				text: t("bottom")
			}],
		}
    }]
});    

Vvveb.Components.extend("_base", "html/container", {
    classes: ["container", "container-fluid"],
    image: "icons/container.svg",
    html: '<div class="container" style="min-height:150px;"><div class="m-5">Container</div></div>',
    name: "Container",
    properties: [
     {
        name: t("Type"),
        key: "type",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["container", "container-fluid"],
        data: {
            options: [{
                value: "container",
                text: t("Default")
            }, {
                value: "container-fluid",
                text: t("Fluid")
            }]
        }
    },
	{
        name: t("Background"),
        key: "background",
		htmlAttr: "class",
        validValues: bgcolorClasses,
        inputtype: SelectInput,
        data: {
            options: bgcolorSelectOptions
        }
    },
	{
        name: t("Background Color"),
        key: "background-color",
		htmlAttr: "style",
        inputtype: ColorInput,
    },
	{
        name: t("Text Color"),
        key: "color",
		htmlAttr: "style",
        inputtype: ColorInput,
    }],
});

Vvveb.Components.extend("_base", "html/heading", {
    image: "icons/heading.svg",
    name: t("Heading"),
    nodes: ["h1", "h2","h3", "h4","h5","h6"],
    html: "<h1>Heading</h1>",
    
	properties: [
	{
        name: t("Size"),
        key: "size",
        inputtype: SelectInput,
        
        onChange: function(node, value) {
			
			return changeNodeName(node, "h" + value);
		},	
			
        init: function(node) {
            var regex;
            regex = /H(\d)/.exec(node.nodeName);
            if (regex && regex[1]) {
                return regex[1]
            }
            return 1
        },
        
        data:{
			options: [{
                value: "1",
                text: "1"
            }, {
                value: "2",
                text: "2"
            }, {
                value: "3",
                text: "3"
            }, {
                value: "4",
                text: "4"
            }, {
                value: "5",
                text: "5"
            }, {
                value: "6",
                text: "6"
            }]
       },
    }]
});    
Vvveb.Components.extend("_base", "html/link", {
    nodes: ["a"],
    name: t("Link"),
    html: '<a href="#" class="d-inline-block">Link</a>',
	image: "icons/link.svg",
    properties: [{
        name: t("URL"),
        key: "href",
        htmlAttr: "href",
        inputtype: LinkInput
    }, {
        name: t("Target"),
        key: "target",
        htmlAttr: "target",
        inputtype: SelectInput,
        data:{options: [{value:null,text:"Same Tab"},{value:"_BLANK",text:"New Tab"}]}
    }]
});
Vvveb.Components.extend("_base", "html/image", {
    nodes: ["img"],
    name: t("Image"),
    html: '<img src="' +  Vvveb.baseUrl + 'icons/image.svg" class="img-fluid">',
    /*
    afterDrop: function (node)
	{
		node.attr("src", '');
		return node;
	},*/
    image: "icons/image.svg",
    properties: [{
        name: t("Image"),
        key: "src",
        htmlAttr: "src",
        inputtype: ImageInput
    }, 
    {
        name: t("&nbsp;&nbsp;"),
        key: "cfMediaImg",
        inputtype: ButtonInput,
        data: {text: t("Import Media")},
        onChange: function(node)
        {
            doEditorMediaOpen(
                function(data){
                    $(node).attr('src', data);
                }
            );
            return node;
        }
    },
    {
        name: t("Width"),
        key: "width",
        htmlAttr: "width",
        inputtype: TextInput
    }, {
        name: t("Height"),
        key: "height",
        htmlAttr: "height",
        inputtype: TextInput
    }, {
        name: t("Alt"),
        key: "alt",
        htmlAttr: "alt",
        inputtype: TextInput
    }]
});
Vvveb.Components.add("html/hr", {
    image: "icons/hr.svg",
    nodes: ["hr"],
    name: t("Horizontal Rule"),
    html: "<hr>"
});
Vvveb.Components.extend("_base", "html/label", {
    name: t("Label"),
    nodes: ["label"],
    html: '<label for="">Label</label>',
    properties: [{
        name: t("For id"),
        htmlAttr: "for",
        key: "for",
        inputtype: TextInput
    }]
});
Vvveb.Components.extend("_base", "html/button", {
    classes: ["btn", "btn-link"],
    name: t("Button"),
    image: "icons/button.svg",
    html: '<button type="button" class="btn btn-primary">Primary</button>',
    properties: [{
        name: t("Link To"),
        key: "href",
        htmlAttr: "href",
        inputtype: LinkInput
    }, {
        name: t("Type"),
        key: "type",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["btn-default", "btn-primary", "btn-info", "btn-success", "btn-warning", "btn-info", "btn-light", "btn-dark", "btn-outline-primary", "btn-outline-info", "btn-outline-success", "btn-outline-warning", "btn-outline-info", "btn-outline-light", "btn-outline-dark", "btn-link"],
        data: {
            options: [{
                value: "btn-default",
                text: t("Default")
            }, {
                value: "btn-primary",
                text: t("Primary")
            }, {
                value: "btn btn-info",
                text: t("Info")
            }, {
                value: "btn-success",
                text: t("Success")
            }, {
                value: "btn-warning",
                text: t("Warning")
            }, {
                value: "btn-info",
                text: t("Info")
            }, {
                value: "btn-light",
                text: t("Light")
            }, {
                value: "btn-dark",
                text: t("Dark")
            }, {
                value: "btn-outline-primary",
                text: t("Primary outline")
            }, {
                value: "btn btn-outline-info",
                text: t("Info outline")
            }, {
                value: "btn-outline-success",
                text: t("Success outline")
            }, {
                value: "btn-outline-warning",
                text: t("Warning outline")
            }, {
                value: "btn-outline-info",
                text: t("Info outline")
            }, {
                value: "btn-outline-light",
                text: t("Light outline")
            }, {
                value: "btn-outline-dark",
                text: t("Dark outline")
            }, {
                value: "btn-link",
                text: t("Link")
            }]
        }
    }, {
        name: t("Size"),
        key: "size",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["btn-lg", "btn-sm"],
        data: {
            options: [{
                value: "",
                text: t("Default")
            }, {
                value: "btn-lg",
                text: t("Large")
            }, {
                value: "btn-sm",
                text: t("Small")
            }]
        }
    }, {
        name: t("Target"),
        key: "target",
        htmlAttr: "target",
        inputtype: TextInput
    }, {
        name: t("Disabled"),
        key: "disabled",
        htmlAttr: "class",
        inputtype: ToggleInput,
        validValues: ["disabled"],
        data: {
            on: "disabled",
            off: null
        }
    }]
});
Vvveb.Components.extend("_base", "html/buttongroup", {
    classes: ["btn-group"],
    name: t("Button Group"),
    image: "icons/button_group.svg",
    html: '<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-secondary">Left</button><button type="button" class="btn btn-secondary">Middle</button> <button type="button" class="btn btn-secondary">Right</button></div>',
	properties: [{
	    name: t("Size"),
        key: "size",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["btn-group-lg", "btn-group-sm"],
        data: {
            options: [{
                value: "",
                text: t("Default")
            }, {
                value: "btn-group-lg",
                text: t("Large")
            }, {
                value: "btn-group-sm",
                text: t("Small")
            }]
        }
    }, {
	    name: t("Alignment"),
        key: "alignment",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["btn-group", "btn-group-vertical"],
        data: {
            options: [{
                value: "",
                text: t("Default")
            }, {
                value: "btn-group",
                text: t("Horizontal")
            }, {
                value: "btn-group-vertical",
                text: t("Vertical")
            }]
        }
    }]
});
Vvveb.Components.extend("_base", "html/buttontoolbar", {
    classes: ["btn-toolbar"],
    name: t("Button Toolbar"),
    image: "icons/button_toolbar.svg",
    html: '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">\
		  <div class="btn-group mr-2" role="group" aria-label="First group">\
			<button type="button" class="btn btn-secondary">1</button>\
			<button type="button" class="btn btn-secondary">2</button>\
			<button type="button" class="btn btn-secondary">3</button>\
			<button type="button" class="btn btn-secondary">4</button>\
		  </div>\
		  <div class="btn-group mr-2" role="group" aria-label="Second group">\
			<button type="button" class="btn btn-secondary">5</button>\
			<button type="button" class="btn btn-secondary">6</button>\
			<button type="button" class="btn btn-secondary">7</button>\
		  </div>\
		  <div class="btn-group" role="group" aria-label="Third group">\
			<button type="button" class="btn btn-secondary">8</button>\
		  </div>\
		</div>'
});
Vvveb.Components.extend("_base","html/alert", {
    classes: ["alert"],
    name: t("Alert"),
    image: "icons/alert.svg",
    html: '<div class="alert alert-warning alert-dismissible fade show" role="alert">\
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
			<span aria-hidden="true">&times;</span>\
		  </button>\
		  <strong>Holy guacamole!</strong> You should check in on some of those fields below.\
		</div>',
    properties: [{
        name: t("Type"),
        key: "type",
        htmlAttr: "class",
        validValues: ["alert-primary", "alert-secondary", "alert-success", "alert-danger", "alert-warning", "alert-info", "alert-light", "alert-dark"],
        inputtype: SelectInput,
        data: {
            options: [{
                value: "alert-primary",
                text: t("Default")
            }, {
                value: "alert-secondary",
                text: t("Secondary")
            }, {
                value: "alert-success",
                text: t("Success")
            }, {
                value: "alert-danger",
                text: t("Danger")
            }, {
                value: "alert-warning",
                text: t("Warning")
            }, {
                value: "alert-info",
                text: t("Info")
            }, {
                value: "alert-light",
                text: t("Light")
            }, {
                value: "alert-dark",
                text: t("Dark")
            }]
        }
    }]
});
Vvveb.Components.extend("_base", "html/badge", {
    classes: ["badge"],
    image: "icons/badge.svg",
    name: t("Badge"),
    html: '<span class="badge badge-primary">Primary badge</span>',
    properties: [{
        name: t("Color"),
        key: "color",
        htmlAttr: "class",
        validValues:["badge-primary", "badge-secondary", "badge-success", "badge-danger", "badge-warning", "badge-info", "badge-light", "badge-dark"],
        inputtype: SelectInput,
        data: {
            options: [{
                value: "",
                text: t("Default")
            }, {
                value: "badge-primary",
                text: t("Primary")
            }, {
                value: "badge-secondary",
                text: t("Secondary")
            }, {
                value: "badge-success",
                text: t("Success")
            }, {
                value: "badge-warning",
                text: t("Warning")
            }, {
                value: "badge-danger",
                text: t("Danger")
            }, {
                value: "badge-info",
                text: t("Info")
            }, {
                value: "badge-light",
                text: t("Light")
            }, {
                value: "badge-dark",
                text: t("Dark")
            }]
        }
     }]
});
Vvveb.Components.extend("_base", "html/card", {
    classes: ["card"],
    image: "icons/panel.svg",
    name: t("Card"),
    html: `<div class="card">
          <div class="card-header" style="font-size:20px">Card</div>
		  <div class="card-body">\
			<h4 class="card-title">Card title</h4>\
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p>\
			<a href="#" class="btn btn-primary">Go somewhere</a>\
          </div>\
          <div class="card-footer">Here some footer text</div>
		</div>`
});
Vvveb.Components.extend("_base", "html/listgroup", {
    name: t("List Group"),
    image: "icons/list_group.svg",
    classes: ["list-group"],
    html: '<ul class="list-group">\n  <li class="list-group-item">\n    <span class="badge">14</span>\n    Cras justo odio\n  </li>\n  <li class="list-group-item">\n    <span class="badge">2</span>\n    Dapibus ac facilisis in\n  </li>\n  <li class="list-group-item">\n    <span class="badge">1</span>\n    Morbi leo risus\n  </li>\n</ul>'
});
Vvveb.Components.extend("_base", "html/listitem", {
    name: t("List Item"),
    classes: ["list-group-item"],
    html: '<li class="list-group-item"><span class="badge">14</span> Cras justo odio</li>'
});
Vvveb.Components.extend("_base", "html/breadcrumbs", {
    classes: ["breadcrumb"],
    name: t("Breadcrumbs"),
    image: "icons/breadcrumbs.svg",
    html: '<ol class="breadcrumb">\
		  <li class="breadcrumb-item active"><a href="#">Home</a></li>\
		  <li class="breadcrumb-item active"><a href="#">Library</a></li>\
		  <li class="breadcrumb-item active">Data 3</li>\
		</ol>'
});
Vvveb.Components.extend("_base", "html/breadcrumbitem", {
	classes: ["breadcrumb-item"],
    name: t("Breadcrumb Item"),
    html: '<li class="breadcrumb-item"><a href="#">Library</a></li>',
    properties: [{
        name: t("Active"),
        key: "active",
        htmlAttr: "class",
        validValues: ["", "active"],
        inputtype: ToggleInput,
        data: {
            on: "active",
            off: ""
        }
    }]
});
Vvveb.Components.extend("_base", "html/pagination", {
    classes: ["pagination"],
    name: t("Pagination"),
    image: "icons/pagination.svg",
    html: '<nav aria-label="Page navigation example">\
	  <ul class="pagination">\
		<li class="page-item"><a class="page-link" href="#">Previous</a></li>\
		<li class="page-item"><a class="page-link" href="#">1</a></li>\
		<li class="page-item"><a class="page-link" href="#">2</a></li>\
		<li class="page-item"><a class="page-link" href="#">3</a></li>\
		<li class="page-item"><a class="page-link" href="#">Next</a></li>\
	  </ul>\
	</nav>',

    properties: [{
        name: t("Size"),
        key: "size",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["btn-lg", "btn-sm"],
        data: {
            options: [{
                value: "",
                text: t("Default")
            }, {
                value: "btn-lg",
                text: t("Large")
            }, {
                value: "btn-sm",
                text: t("Small")
            }]
        }
    },{
        name: t("Alignment"),
        key: "alignment",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["justify-content-center", "justify-content-end"],
        data: {
            options: [{
                value: "",
                text: t("Default")
            }, {
                value: "justify-content-center",
                text: t("Center")
            }, {
                value: "justify-content-end",
                text: t("Right")
            }]
        }
    }]	
});
Vvveb.Components.extend("_base", "html/pageitem", {
	classes: ["page-item"],
    html: '<li class="page-item"><a class="page-link" href="#">1</a></li>',
    name: t("Pagination Item"),
    properties: [{
        name: t("Link To"),
        key: "href",
        htmlAttr: "href",
        child:".page-link",
        inputtype: TextInput
    }, {
        name: t("Disabled"),
        key: "disabled",
        htmlAttr: "class",
        validValues: ["disabled"],
        inputtype: ToggleInput,
        data: {
            on: "disabled",
            off: ""
        }
   }]
});
Vvveb.Components.extend("_base", "html/progress", {
    classes: ["progress"],
    name: t("Progress Bar"),
    image: "icons/progressbar.svg",
    html: '<div class="progress"><div class="progress-bar w-25"></div></div>',
    properties: [{
        name: t("Background"),
        key: "background",
		htmlAttr: "class",
        validValues: bgcolorClasses,
        inputtype: SelectInput,
        data: {
            options: bgcolorSelectOptions
        }
    },
    {
        name: t("Progress"),
        key: "background",
        child:".progress-bar",
		htmlAttr: "class",
        validValues: ["", "w-25", "w-50", "w-75", "w-100"],
        inputtype: SelectInput,
        data: {
            options: [{
                value: "",
                text: t("None")
            }, {
                value: "w-25",
                text: t("25%")
            }, {
                value: "w-50",
                text: t("50%")
            }, {
                value: "w-75",
                text: t("75%")
            }, {
                value: "w-100",
                text: t("100%")
            }]
        }
    }, 
    {
        name: t("Progress background"),
        key: "background",
        child:".progress-bar",
		htmlAttr: "class",
        validValues: bgcolorClasses,
        inputtype: SelectInput,
        data: {
            options: bgcolorSelectOptions
        }
    }, {
        name: t("Striped"),
        key: "striped",
        child:".progress-bar",
        htmlAttr: "class",
        validValues: ["", "progress-bar-striped"],
        inputtype: ToggleInput,
        data: {
            on: "progress-bar-striped",
            off: "",
        }
    }, {
        name: t("Animated"),
        key: "animated",
        child:".progress-bar",
        htmlAttr: "class",
        validValues: ["", "progress-bar-animated"],
        inputtype: ToggleInput,
        data: {
            on: "progress-bar-animated",
            off: "",
        }
    }]
});
Vvveb.Components.extend("_base", "html/jumbotron", {
    classes: ["jumbotron"],
    image: "icons/jumbotron.svg",
    name: t("Jumbotron"),
    html: '<div class="jumbotron">\
		  <h1 class="display-3">Hello, world!</h1>\
		  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>\
		  <hr class="my-4">\
		  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>\
		  <p class="lead">\
			<a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>\
		  </p>\
		</div>'
});
Vvveb.Components.extend("_base", "html/navbar", {
    classes: ["navbar"],
    image: "icons/navbar.svg",
    name: t("Nav Bar"),
    html: '<nav class="navbar navbar-expand-lg navbar-light bg-light">\
		  <a class="navbar-brand" href="#">Navbar</a>\
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">\
			<span class="navbar-toggler-icon"></span>\
		  </button>\
		\
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">\
			<ul class="navbar-nav mr-auto">\
			  <li class="nav-item active">\
				<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>\
			  </li>\
			  <li class="nav-item">\
				<a class="nav-link" href="#">Link</a>\
			  </li>\
			  <li class="nav-item">\
				<a class="nav-link disabled" href="#">Disabled</a>\
			  </li>\
			</ul>\
			<form class="form-inline my-2 my-lg-0">\
			  <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">\
			  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>\
			</form>\
		  </div>\
		</nav>',
    
    properties: [{
        name: t("Color theme"),
        key: "color",
        htmlAttr: "class",
        validValues: ["navbar-light", "navbar-dark"],
        inputtype: SelectInput,
        data: {
            options: [{
                value: "",
                text: t("Default")
            }, {
                value: "navbar-light",
                text: t("Light")
            }, {
                value: "navbar-dark",
                text: t("Dark")
            }]
        }
    },{
        name: t("Background color"),
        key: "background",
        htmlAttr: "class",
        validValues: bgcolorClasses,
        inputtype: SelectInput,
        data: {
            options: bgcolorSelectOptions
        }
    }, {
        name: t("Placement"),
        key: "placement",
        htmlAttr: "class",
        validValues: ["fixed-top", "fixed-bottom", "sticky-top"],
        inputtype: SelectInput,
        data: {
            options: [{
                value: "",
                text: t("Default")
            }, {
                value: "fixed-top",
                text: t("Fixed Top")
            }, {
                value: "fixed-bottom",
                text: t("Fixed Bottom")
            }, {
                value: "sticky-top",
                text: t("Sticky top")
            }]
        }
    }]
});

Vvveb.Components.extend("_base", "html/form", {
    nodes: ["form"],
    image: "icons/form.svg",
    name: t("Form"),
    html: `<form action="" method="POST"><div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd">
  </div>
  <div class="checkbox">
    <label><input type="checkbox"> Remember me</label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button></form>`,
    properties: [{
        name: t("Style"),
        key: "style",
        htmlAttr: "class",
        validValues: ["", "form-search", "form-inline", "form-horizontal"],
        inputtype: SelectInput,
        data: {
            options: [{
                value: "",
                text: t("Default")
            }, {
                value: "form-search",
                text: t("Search")
            }, {
                value: "form-inline",
                text: t("Inline")
            }, {
                value: "form-horizontal",
                text: t("Horizontal")
            }]
        }
    }, {
        name: t("Action"),
        key: "action",
        htmlAttr: "action",
        inputtype: TextInput
    }, {
        name: t("Method"),
        key: "method",
        htmlAttr: "method",
        inputtype: TextInput
    }]
});

Vvveb.Components.extend("_base", "html/textinput", {
    name: t("Input"),
	nodes: ["input"],
	//attributes: {"type":"text"},
    image: "icons/text_input.svg",
    html: '<div class="form-group"><label>Text</label><input type="text" class="form-control"></div></div>',
    properties: [{
        name: t("Value"),
        key: "value",
        htmlAttr: "value",
        inputtype: TextInput
    }, {
        name: t("Type"),
        key: "type",
        htmlAttr: "type",
		inputtype: SelectInput,
        data: {
            options: [{
                value: "text",
                text: t("text")
            }, {
                value: "button",
                text: t("button")
            }, {

                value: "checkbox",
                text: t("checkbox")
            }, {

                value: "color",
                text: t("color")
            }, {

                value: "date",
                text: t("date")
            }, {

                value: "datetime-local",
                text: t("datetime-local")
            }, {

                value: "email",
                text: t("email")
            }, {

                value: "file",
                text: t("file")
            }, {

                value: "hidden",
                text: t("hidden")
            }, {

                value: "image",
                text: t("image")
            }, {

                value: "month",
                text: t("month")
            }, {

                value: "number",
                text: t("number")
            }, {

                value: "password",
                text: t("password")
            }, {

                value: "radio",
                text: t("radio")
            }, {

                value: "range",
                text: t("range")
            }, {

                value: "reset",
                text: t("reset")
            }, {

                value: "search",
                text: t("search")
            }, {

                value: "submit",
                text: t("submit")
            }, {

                value: "tel",
                text: t("tel")
            }, {

                value: "text",
                text: t("text")
            }, {

                value: "time",
                text: t("time")
            }, {

                value: "url",
                text: t("url")
            }, {

                value: "week",
                text: t("week")
            }]
        }
    }, {
        name: t("Placeholder"),
        key: "placeholder",
        htmlAttr: "placeholder",
        inputtype: TextInput
    }, /*{
        name: "Disabled",
        key: "disabled",
        htmlAttr: "disabled",
		col:6,
        inputtype: CheckboxInput,
	},{
        name: "Required",
        key: "required",
        htmlAttr: "required",
		col:6,
        inputtype: CheckboxInput,
	}*/]
});

Vvveb.Components.extend("_base", "html/selectinput", {
	nodes: ["select"],
    name: t("Select Input"),
    image: "icons/select_input.svg",
    html: '<div class="form-group"><label>Choose an option </label><select class="form-control"><option value="value1">Text 1</option><option value="value2">Text 2</option><option value="value3">Text 3</option></select></div>',

	beforeInit: function (node)
	{
		properties = [];
		var i = 0;
		
		$(node).find('option').each(function() {

			data = {"value": this.value, "text": this.text};
			
			i++;
			properties.push({
				name: "Option " + i,
				key: "option" + i,
				//index: i - 1,
				optionNode: this,
				inputtype: TextValueInput,
				data: data,
				onChange: function(node, value, input) {
					
					option = $(this.optionNode);
					
					//if remove button is clicked remove option and render row properties
					if (input.nodeName == 'BUTTON')
					{
						option.remove();
						Vvveb.Components.render("html/selectinput");
						return node;
					}

					if (input.name == "value") option.attr("value", value); 
					else if (input.name == "text") option.text(value);
					
					return node;
				},	
			});
		});
		
		//remove all option properties
		this.properties = this.properties.filter(function(item) {
			return item.key.indexOf("option") === -1;
		});
		
		//add remaining properties to generated column properties
		properties.push(this.properties[0]);
		
		this.properties = properties;
		return node;
	},
    
    properties: [{
        name: t("Option"),
        key: "option1",
        inputtype: TextValueInput
	}, {
        name: t("Option"),
        key: "option2",
        inputtype: TextValueInput
	}, {
        name: "",
        key: "addChild",
        inputtype: ButtonInput,
        data: {text:"Add option", icon:"la-plus"},
        onChange: function(node)
        {
			 $(node).append('<option value="value">Text</option>');
			 
			 //render component properties again to include the new column inputs
			 Vvveb.Components.render("html/selectinput");
			 
			 return node;
		}
	}]
});
Vvveb.Components.extend("_base", "html/textareainput", {
    name: t("Text Area"),
    image: "icons/text_area.svg",
    html: '<div class="form-group"><label>Your response:</label><textarea class="form-control"></textarea></div>'
});
Vvveb.Components.extend("_base", "html/radiobutton", {
    name: t("Radio Button"),
	attributes: {"type":"radio"},
    image: "icons/radio.svg",
    html: '<label class="radio"><input type="radio"> Radio</label>',
    properties: [
    {
        name: t("Value"),
        key: "value",
        htmlAttr: "value",
        inputtype: TextInput
    }
    ]
});
Vvveb.Components.extend("_base", "html/checkbox", {
    name: t("Checkbox"),
    attributes: {"type":"checkbox"},
    image: "icons/checkbox.svg",
    html: '<label class="checkbox"><input type="checkbox"> Checkbox</label>',
    properties: [
    {
        name: t("Value"),
        key: "value",
        htmlAttr: "value",
        inputtype: TextInput
    }
]
});
Vvveb.Components.extend("_base", "html/fileinput", {
    name: t("Input group"),
	attributes: {"type":"file"},
    image: "icons/text_input.svg",
    html: '<div class="form-group">\
			  <input type="file" class="form-control">\
			</div>'
});
Vvveb.Components.extend("_base", "html/table", {
    nodes: ["table"],
    classes: ["table"],
    attributes: ["data-component-table"],
    image: "icons/table.svg",
    name: t("Table"),
    html: '<div class="table-responsive" style="padding:6px;" data-component-table><table class="table">\
		  <thead>\
			<tr>\
			  <th>#</th>\
			  <th>First Name</th>\
			  <th>Last Name</th>\
			  <th>Username</th>\
			</tr>\
		  </thead>\
		  <tbody>\
			<tr>\
			  <th scope="row">1</th>\
			  <td>Mark</td>\
			  <td>Otto</td>\
			  <td>@mdo</td>\
			</tr>\
			<tr>\
			  <th scope="row">2</th>\
			  <td>Jacob</td>\
			  <td>Thornton</td>\
			  <td>@fat</td>\
			</tr>\
			<tr>\
			  <th scope="row">3</th>\
			  <td>Larry</td>\
			  <td>the Bird</td>\
			  <td>@twitter</td>\
			</tr>\
		  </tbody>\
		</table></div>',
    properties: [
	{
        name: t("Type"),
        key: "type",
		htmlAttr: "class",
        validValues: ["table-primary", "table-secondary", "table-success", "table-danger", "table-warning", "table-info", "table-light", "table-dark", "table-white"],
        inputtype: SelectInput,
        data: {
            options: [{
				value: "Default",
				text: ""
			}, {
				value: "table-primary",
				text: t("Primary")
			}, {
				value: "table-secondary",
				text: t("Secondary")
			}, {
				value: "table-success",
				text: t("Success")
			}, {
				value: "table-danger",
				text: t("Danger")
			}, {
				value: "table-warning",
				text: t("Warning")
			}, {
				value: "table-info",
				text: t("Info")
			}, {
				value: "table-light",
				text: t("Light")
			}, {
				value: "table-dark",
				text: t("Dark")
			}, {
				value: "table-white",
				text: t("White")
			}]
        }
    },
	{
        name: t("Responsive"),
        key: "responsive",
        htmlAttr: "class",
        validValues: ["table-responsive"],
        inputtype: ToggleInput,
        data: {
            on: "table-responsive",
            off: ""
        }
    },   
	{
        name: t("Small"),
        key: "small",
        htmlAttr: "class",
        validValues: ["table-sm"],
        inputtype: ToggleInput,
        data: {
            on: "table-sm",
            off: ""
        }
    },   
	{
        name: t("Hover"),
        key: "hover",
        htmlAttr: "class",
        validValues: ["table-hover"],
        inputtype: ToggleInput,
        data: {
            on: "table-hover",
            off: ""
        }
    },   
	{
        name: t("Bordered"),
        key: "bordered",
        htmlAttr: "class",
        validValues: ["table-bordered"],
        inputtype: ToggleInput,
        data: {
            on: "table-bordered",
            off: ""
        }
    },   
	{
        name: t("Striped"),
        key: "striped",
        htmlAttr: "class",
        validValues: ["table-striped"],
        inputtype: ToggleInput,
        data: {
            on: "table-striped",
            off: ""
        }
    },   
	{
        name: t("Inverse"),
        key: "inverse",
        htmlAttr: "class",
        validValues: ["table-inverse"],
        inputtype: ToggleInput,
        data: {
            on: "table-inverse",
            off: ""
        }
    },   
    {
        name: t("Head options"),
        key: "head",
        htmlAttr: "class",
        child:"thead",
        inputtype: SelectInput,
        validValues: ["", "thead-inverse", "thead-default"],
        data: {
            options: [{
                value: "",
                text: t("None")
            }, {
                value: "thead-default",
                text: t("Default")
            }, {
                value: "thead-inverse",
                text: t("Inverse")
            }]
        }
    }]
});
Vvveb.Components.extend("_base", "html/tablerow", {
    nodes: ["tr"],
    name: t("Table Row"),
    html: "<tr><td>Cell 1</td><td>Cell 2</td><td>Cell 3</td></tr>",
    properties: [{
        name: t("Type"),
        key: "type",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["", "success", "danger", "warning", "active"],
        data: {
            options: [{
                value: "",
                text: t("Default")
            }, {
                value: "success",
                text: t("Success")
            }, {
                value: "error",
                text: t("Error")
            }, {
                value: "warning",
                text: t("Warning")
            }, {
                value: "active",
                text: t("Active")
            }]
        }
    }]
});
Vvveb.Components.extend("_base", "html/tablecell", {
    nodes: ["td"],
    name: t("Table Cell"),
    html: "<td>Cell</td>"
});
Vvveb.Components.extend("_base", "html/tableheadercell", {
    nodes: ["th"],
    name: t("Table Header Cell"),
    html: "<th>Head</th>"
});
Vvveb.Components.extend("_base", "html/tablehead", {
    nodes: ["thead"],
    name: t("Table Head"),
    html: "<thead><tr><th>Head 1</th><th>Head 2</th><th>Head 3</th></tr></thead>",
    properties: [{
        name: t("Type"),
        key: "type",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["", "success", "danger", "warning", "info"],
        data: {
            options: [{
                value: "",
                text: t("Default")
            }, {
                value: "success",
                text: t("Success")
            }, {
                value: "anger",
                text: t("Error")
            }, {
                value: "warning",
                text: t("Warning")
            }, {
                value: "info",
                text: t("Info")
            }]
        }
    }]
});
Vvveb.Components.extend("_base", "html/tablebody", {
    nodes: ["tbody"],
    name: t("Table Body"),
    html: "<tbody><tr><td>Cell 1</td><td>Cell 2</td><td>Cell 3</td></tr></tbody>"
});

Vvveb.Components.add("html/gridcolumn", {
    name: t("Grid Column"),
    image: "icons/grid_row.svg",
    classesRegex: ["col-"],
    html: '<div class="col-sm-4"><h3>col-sm-4</h3></div>',
    properties: [{
        name: t("Column"),
        key: "column",
        inputtype: GridInput,
        data: {hide_remove:true},
		
		beforeInit: function(node) {
			_class = $(node).attr("class");
			
			var reg = /col-([^-\$ ]*)?-?(\d+)/g; 
			var match;

			while ((match = reg.exec(_class)) != null) {
				this.data["col" + ((match[1] != undefined)?"_" + match[1]:"")] = match[2];
			}
		},
		
		onChange: function(node, value, input) {
			var _class = node.attr("class");
			
			//remove previous breakpoint column size
			_class = _class.replace(new RegExp(input.name + '-\\d+?'), '');
			//add new column size
			if (value) _class +=  ' ' + input.name + '-' + value;
			node.attr("class", _class);
			
			return node;
		},				
	}]
});
Vvveb.Components.add("html/gridrow", {
    name: t("Grid Row"),
    image: "icons/grid_row.svg",
    classes: ["row"],
    html: '<div class="row"><div class="col-sm-4"><h3>col-sm-4</h3></div><div class="col-sm-4 col-5"><h3>col-sm-4</h3></div><div class="col-sm-4"><h3>col-sm-4</h3></div></div>',
    children :[{
		name: t("html/gridcolumn"),
		classesRegex: ["col-"],
	}],
	beforeInit: function (node)
	{
		properties = [];
		var i = 0;
		var j = 0;
		
		$(node).find('[class*="col-"]').each(function() {
			_class = $(this).attr("class");
			
			var reg = /col-([^-\$ ]*)?-?(\d+)/g; 
			var match;
			var data = {};

			while ((match = reg.exec(_class)) != null) {
				data["col" + ((match[1] != undefined)?"_" + match[1]:"")] = match[2];
			}
			
			i++;
			properties.push({
				name: "Column " + i,
				key: "column" + i,
				//index: i - 1,
				columnNode: this,
				col:12,
				inline:true,
				inputtype: GridInput,
				data: data,
				onChange: function(node, value, input) {

					//column = $('[class*="col-"]:eq(' + this.index + ')', node);
					var column = $(this.columnNode);
					
					//if remove button is clicked remove column and render row properties
					if (input.nodeName == 'BUTTON')
					{
						column.remove();
						Vvveb.Components.render("html/gridrow");
						return node;
					}

					//if select input then change column class
					_class = column.attr("class");
					
					//remove previous breakpoint column size
					_class = _class.replace(new RegExp(input.name + '-\\d+?'), '');
					//add new column size
					if (value) _class +=  ' ' + input.name + '-' + value;
					column.attr("class", _class);
					
					//console.log(this, node, value, input, input.name);
					
					return node;
				},	
			});
		});
		
		//remove all column properties
		this.properties = this.properties.filter(function(item) {
			return item.key.indexOf("column") === -1;
		});
		
		//add remaining properties to generated column properties
		properties.push(this.properties[0]);
		
		this.properties = properties;
		return node;
	},
    
    properties: [{
        name: t("Column"),
        key: "column1",
        inputtype: GridInput
	}, {
        name: t("Column"),
        key: "column1",
        inline:true,
        col:12,
        inputtype: GridInput
	}, {
        name: "",
        key: "addChild",
        inputtype: ButtonInput,
        data: {text:"Add column", icon:"la la-plus"},
        onChange: function(node)
        {
			 $(node).append('<div class="col-3">Col-3</div>');
			 
			 //render component properties again to include the new column inputs
			 Vvveb.Components.render("html/gridrow");
			 
			 return node;
		}
	}]
});


Vvveb.Components.extend("_base", "html/paragraph", {
    nodes: ["p"],
    name: t("Paragraph"),
	image: "icons/paragraph.svg",
	html: '<p>Lorem ipsum</p>',
    properties: [{
        name: t("Text align"),
        key: "text-align",
        htmlAttr: "class",
        inputtype: SelectInput,
        validValues: ["", "text-left", "text-center", "text-right"],
        inputtype: RadioButtonInput,
        data: {
			extraclass:"btn-group-sm btn-group-fullwidth",
            options: [{
                value: "",
                icon:"la la-close",
                //text: "None",
                title: t("None"),
                checked:true,
            }, {
                value: "left",
                //text: "Left",
                title: t("text-left"),
                icon:"la la-align-left",
                checked:false,
            }, {
                value: "text-center",
                //text: "Center",
                title: t("Center"),
                icon:"la la-align-center",
                checked:false,
            }, {
                value: "text-right",
                //text: "Right",
                title: t("Right"),
                icon:"la la-align-right",
                checked:false,
            }],
        },
	}]
});

Vvveb.Components.extend("_base", "html/video", {
    nodes: ["video"],
    name: t("Video"),
    html: '<video width="320" height="240" playsinline loop autoplay><source src="https://storage.googleapis.com/coverr-main/mp4/Mt_Baker.mp4"><video>',
    dragHtml: '<img  width="320" height="240" src="' + Vvveb.baseUrl + 'icons/video.svg">',
	image: "icons/video.svg",
    properties: [{
        name: t("Src"),
        child: "source",
        key: "src",
        htmlAttr: "src",
        inputtype: LinkInput
    },{
        name: t("Width"),
        key: "width",
        htmlAttr: "width",
        inputtype: TextInput
    }, {
        name: t("Height"),
        key: "height",
        htmlAttr: "height",
        inputtype: TextInput
    },{
        name: t("Muted"),
        key: "muted",
        htmlAttr: "muted",
        inputtype: CheckboxInput
    },{
        name: t("Loop"),
        key: "loop",
        htmlAttr: "loop",
        inputtype: CheckboxInput
    },{
        name: t("Autoplay"),
        key: "autoplay",
        htmlAttr: "autoplay",
        inputtype: CheckboxInput
    },{
        name: t("Plays inline"),
        key: "playsinline",
        htmlAttr: "playsinline",
        inputtype: CheckboxInput
    },{
        name: t("Controls"),
        key: "controls",
        htmlAttr: "controls",
        inputtype: CheckboxInput
    }]
});


Vvveb.Components.extend("_base", "html/button", {
    nodes: ["button"],
    name: t("Html Button"),
    image: "icons/button.svg",
    html: '<button class="btn btn-primary">Button</button>',
    properties: [{
        name: t("Text"),
        key: "text",
        htmlAttr: "innerHTML",
        inputtype: TextInput
    }, {
        name: t("Name"),
        key: "name",
        htmlAttr: "name",
        inputtype: TextInput
    },
    {
        name: t("Value"),
        key: "valuee",
        htmlAttr: "value",
        inputtype: TextInput
    }
    , {
        name: t("Type"),
        key: "type",
		htmlAttr: "type",
        inputtype: SelectInput,
        data: {
			options: [{
				value: "button",
				text: t("button")
			}, {	
				value: "reset",
				text: t("reset")
			}, {
				value: "submit",
				text: t("submit")
			}],
		}
   	},{
        name: t("Autofocus"),
        key: "autofocus",
        htmlAttr: "autofocus",
        inputtype: CheckboxInput,
		inline:true,
        col:6,
   	},{
        name: t("Disabled"),
        key: "disabled",
        htmlAttr: "disabled",
        inputtype: CheckboxInput,		
		inline:true,
        col:6,
    }]
});   

Vvveb.Components.extend("_base", "_base", {
	 properties: [
	 {
        name: t("Font family"),
        key: "font-family",
		htmlAttr: "style",
        sort: base_sort++,
        col:6,
		inline:true,
        inputtype: SelectInput,
        data: {
			options: [{
				value: "",
				text: t("extended")
			}, {
				value: "Ggoogle ",
				text: t("google")
			}]
		}
    }]
});
