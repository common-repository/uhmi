!function(e){var t=e.element.createElement,o=e.blocks.registerBlockType,i={backgroundColor:"#f8f9f9",color:"#333333",padding:"10px 15px",fontSize:"18px",fontWeight:600};o("uhmi/uhmi-shortcode",{title:"Uhmi shortcode",icon:"shortcode",category:"uhmi",keywords:["Uhmi","Content"],edit:function(e){return t("p",{style:i},"[uhmi]")},save:function(){return"[uhmi]"}}),o("uhmi/uhmi-shortcode-close",{title:UHMI_SHORTCODE_CLOSE,icon:"shortcode",category:"uhmi",keywords:["Uhmi","Content",UHMI_CLOSE],edit:function(e){return t("p",{style:i},"[/uhmi]")},save:function(){return"[/uhmi]"}})}(window.wp);