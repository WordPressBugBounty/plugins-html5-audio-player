!function(e){function t(l){if(n[l])return n[l].exports;var r=n[l]={i:l,l:!1,exports:{}};return e[l].call(r.exports,r,r.exports,t),r.l=!0,r.exports}var n={};t.m=e,t.c=n,t.d=function(e,n,l){t.o(e,n)||Object.defineProperty(e,n,{configurable:!1,enumerable:!0,get:l})},t.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(n,"a",n),n},t.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},t.p="",t(t.s=0)}([function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var l=n(1),r=(n.n(l),n(2)),c=(n.n(r),n(3));n.n(c)},function(e,t){var n=wp.blocks.registerBlockType,l=wp.data.withSelect,r=wp.blockEditor,c=r.BlockControls,o=r.AlignmentToolbar,a=wp.components,i=a.SelectControl,u=a.Spinner;n("h5ap/existing",{title:"HTML5 Audio Player - Insert",description:"Insert from existing Player",icon:wp.element.createElement("svg",{xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",viewBox:"0 0 93.038 93.038"},wp.element.createElement("path",{d:"M46.547,75.521c0,1.639-0.947,3.128-2.429,3.823c-0.573,0.271-1.187,0.402-1.797,0.402c-0.966,0-1.923-0.332-2.696-0.973   l-23.098-19.14H4.225C1.892,59.635,0,57.742,0,55.409V38.576c0-2.334,1.892-4.226,4.225-4.226h12.303l23.098-19.14   c1.262-1.046,3.012-1.269,4.493-0.569c1.481,0.695,2.429,2.185,2.429,3.823L46.547,75.521L46.547,75.521z M62.784,68.919   c-0.103,0.007-0.202,0.011-0.304,0.011c-1.116,0-2.192-0.441-2.987-1.237l-0.565-0.567c-1.482-1.479-1.656-3.822-0.408-5.504   c3.164-4.266,4.834-9.323,4.834-14.628c0-5.706-1.896-11.058-5.484-15.478c-1.366-1.68-1.24-4.12,0.291-5.65l0.564-0.565   c0.844-0.844,1.975-1.304,3.199-1.231c1.192,0.06,2.305,0.621,3.061,1.545c4.977,6.09,7.606,13.484,7.606,21.38   c0,7.354-2.325,14.354-6.725,20.24C65.131,68.216,64.007,68.832,62.784,68.919z M80.252,81.976   c-0.764,0.903-1.869,1.445-3.052,1.495c-0.058,0.002-0.117,0.004-0.177,0.004c-1.119,0-2.193-0.442-2.988-1.237l-0.555-0.555   c-1.551-1.55-1.656-4.029-0.246-5.707c6.814-8.104,10.568-18.396,10.568-28.982c0-11.011-4.019-21.611-11.314-29.847   c-1.479-1.672-1.404-4.203,0.17-5.783l0.554-0.555c0.822-0.826,1.89-1.281,3.115-1.242c1.163,0.033,2.263,0.547,3.036,1.417   c8.818,9.928,13.675,22.718,13.675,36.01C93.04,59.783,88.499,72.207,80.252,81.976z"})),category:"media",keywords:["html5 audio player","audio player","audio"],attributes:{selectedPlayer:{type:"string",default:""},contentAlign:{type:"string",default:"left"}},edit:l(function(e,t){var n={per_page:-1};return{posts:e("core").getEntityRecords("postType","audioplayer",n)}})(function(e){var t=e.posts,n=e.attributes,l=e.setAttributes,r=n.selectedPlayer,a=n.contentAlign;if(!t)return wp.element.createElement("h3",{style:{color:"#4527a4"}},wp.element.createElement(u,null)," Loading...");var p=t&&0!==t.length?t.map(function(e){return{value:e.id,label:e.title.rendered}}):[{value:"empty",label:"No Player Found"}];return p.unshift({value:"empty",label:"Select a Player"}),wp.element.createElement("div",{className:"h5ap_block_free_existing",style:{textAlign:a}},wp.element.createElement(c,null,wp.element.createElement(o,{value:a,onChange:function(e){return l({contentAlign:e})}})),wp.element.createElement("div",{style:{display:"inline-flex"}},wp.element.createElement("label",{htmlFor:"bBlocksModalBtnLabel",style:{marginRight:"20px",fontWeight:"bold"}},"HTML5 Audio Player:"),wp.element.createElement(i,{value:r,onChange:function(e){return l({selectedPlayer:e})},options:p})))}),save:function(){return null},example:{attributes:{preview:!0}}})},function(e,t){},function(e,t){}]);