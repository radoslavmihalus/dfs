(function(){Tracy=window.Tracy||{};Tracy.Dumper=Tracy.Dumper||{};Tracy.Dumper.init=function(a,e){a&&[].forEach.call((e||document).querySelectorAll(".tracy-dump[data-tracy-dump]"),function(c){try{c.appendChild(k(JSON.parse(c.getAttribute("data-tracy-dump")),a,c.classList.contains("tracy-collapsed"))),c.classList.remove("tracy-collapsed"),c.removeAttribute("data-tracy-dump")}catch(b){if(!(b instanceof m))throw b;}});this.inited||(this.inited=!0,document.body.addEventListener("click",function(a){var b;
if(a.ctrlKey&&(b=Tracy.closest(a.target,"[data-tracy-href]")))return location.href=b.getAttribute("data-tracy-href"),!1}),Tracy.Toggle.init())};var k=function(a,e,c,b){var d=null===a?"null":typeof a,h="undefined"===typeof c?14:7;if("null"===d||"string"===d||"number"===d||"boolean"===d)return a="string"===d?'"'+a+'"':(a+"").toUpperCase(),f(null,null,[f("span",{"class":"tracy-dump-"+d.replace("ean","")},[a+"\n"])]);if(Array.isArray(a))return n([f("span",{"class":"tracy-dump-array"},["array"])," ("+
(a[0]&&a.length||"")+")"]," [ ... ]",null===a[0]?null:a,!0===c||a.length>=h,e,b);if("object"===d&&a.number)return f(null,null,[f("span",{"class":"tracy-dump-number"},[a.number+"\n"])]);if("object"===d&&a.type)return f(null,null,[f("span",null,[a.type+"\n"])]);if("object"===d){var d=a.object||a.resource,g=e[d];if(!g)throw new m;b=b||[];recursive=-1<b.indexOf(d);b.push(d);return n([f("span",{"class":a.object?"tracy-dump-object":"tracy-dump-resource",title:g.editor?"Declared in file "+g.editor.file+
" on line "+g.editor.line:null,"data-tracy-href":g.editor?g.editor.url:null},[g.name])," ",f("span",{"class":"tracy-dump-hash"},["#"+d])]," { ... }",g.items,!0===c||recursive||g.items&&g.items.length>=h,e,b)}},n=function(a,e,c,b,d,h){var g,l,k;if(!c||!c.length)return a.push(!c||c.length?e+"\n":"\n"),f(null,null,a);a=f(null,null,[g=f("span",{"class":b?"tracy-toggle tracy-collapsed":"tracy-toggle"},a),"\n",l=f("div",{"class":b?"tracy-collapsed":""})]);b?g.addEventListener("tracy-toggle",k=function(){g.removeEventListener("tracy-toggle",
k);p(l,c,d,h)}):p(l,c,d,h);return a},f=function(a,e,c){a instanceof Node||(a=a?document.createElement(a):document.createDocumentFragment());for(var b in e||{})null!==e[b]&&a.setAttribute(b,e[b]);c=c||[];for(b=0;b<c.length;b++)e=c[b],null!==e&&a.appendChild(e instanceof Node?e:document.createTextNode(e));return a},p=function(a,e,c,b){for(var d=0;d<e.length;d++){var h=e[d][2];f(a,null,[f("span",{"class":"tracy-dump-key"},[e[d][0]]),h?" ":null,h?f("span",{"class":"tracy-dump-visibility"},[1===h?"protected":
"private"]):null," => ",k(e[d][1],c,null,b)])}},m=function(){}})();