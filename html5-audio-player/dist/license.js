(()=>{"use strict";const e=class{constructor(e){let t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};if(!e)return void console.error("modal undefined");const{products:i=[],prefix:n,info:s={},db:c="pdfposter"}=t;this.endpoint="https://api.bplugins.com/wp-json/license/v1/gumroad",this.prefix=n,this.modal=e,this.info=s,this.db=c;const o=document.querySelector(`.${this.prefix}_modal_opener`),a=e.querySelector(".closer"),r=e.querySelector(".agree"),l=e.querySelector(".btn-activate"),d=e.querySelector(".btn-deactivate"),p=e.querySelector(".bpl_loader");this.headers={"content-Type":"application/json"},window.modal=e,window.license=this,o||console.error("opener not found"),a||console.error("closer not found"),p||console.error("loader not found"),o?.addEventListener("click",(t=>{t.preventDefault(),e.style.display="block"})),a?.addEventListener("click",(t=>{t.preventDefault(),e.style.display="none"})),r?.addEventListener("click",(function(){l.disabled=!r?.checked})),l?.addEventListener("click",(async t=>{t.preventDefault(),p.style.display="inline-block",l.disabled=!0;const n=e.querySelector("input.license_key");n?.value?await this.activeLicense(n?.value,i)&&this.setNotice("notice-success","Plugin Activated!, Thank you"):this.setNotice("notice-warning","Please input a license key"),l.disabled=!1,p.style.display="none"})),d?.addEventListener("click",(async t=>{t.preventDefault(),p.style.display="inline-block",d.disabled=!0;const n=e.querySelector("input.license_key");n?.value&&await this.deactiveLicense(n?.value,i)&&this.setNotice("notice-success","License key deactivated."),d.disabled=!1,p.style.display="none"}))}verifyGumroad=(()=>{var e=this;return async function(){let t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[],i=arguments.length>1?arguments[1]:void 0,n={};for(let e of t){let t=await fetch("https://api.gumroad.com/v2/licenses/verify",{method:"POST",headers:{"content-Type":"application/json"},body:JSON.stringify({product_permalink:e,license_key:i})}).then((e=>e.json())).then((e=>e));if(t.success){n=t;break}}const s=e.getQuantity(n),c=n?.purchase?.product_name?.includes("Sumo")||!1,o=n?.purchase?.permalink;return{quantity:s,success:n.success,permalink:o,isAppSumo:c}}})();serverHandler=async e=>{const t={quantity:1,website:window.location?.origin,product:this.db,email:this.info?.email,action:"add",...e};return await fetch(this.endpoint,{method:"POST",headers:{"content-Type":"application/json"},body:JSON.stringify(t)}).then((e=>e.json())).then((e=>e))};activeLicense=async(e,t)=>{const{permalink:i,success:n,quantity:s,isAppSumo:c}=await this.verifyGumroad(t,e);if(n){const{active:t,message:n}=await this.serverHandler({license_key:e,quantity:s,isAppSumo:c});if(t){const t=new FormData;t.append("action",`${this.prefix}_active_license_key`),t.append("activated",1),t.append("license_key",e),t.append("permalink",i);const n=await fetch(this.info?.ajaxUrl,{method:"POST",body:t}).then((e=>e.json())).then((e=>e));return n?.success}this.setNotice("notice-warning",n)}else this.setNotice("notice-warning","Invalid License key")};deactiveLicense=async(e,t)=>{const{permalink:i,success:n,quantity:s,isAppSumo:c}=await this.verifyGumroad(t,e);if(n){if(await this.serverHandler({license_key:e,action:"deactive"})){const e=new FormData;e.append("action",`${this.prefix}_active_license_key`),e.append("activated",0),e.append("license_key","");const t=await fetch(this.info?.ajaxUrl,{method:"POST",body:e}).then((e=>e.json())).then((e=>e));return t?.success}this.setNotice("notice-warning","something went wrong!")}else this.setNotice("notice-warning","invalid license key!")};setNotice(e,t){const i=this.modal.querySelector(".license_notice"),n=document.createElement("div");n.classList=`notice ${e}`,n.innerText=t,i.appendChild(n),setTimeout((()=>{n.remove(),"notice-success"==e&&location.reload()}),3e3)}getQuantity=e=>({"(Single Site)":1,"(3 Sites)":3,"(5 Sites)":5,"(Developer  - Unlimited)":1e3,"(Developer)":1e3}[e?.purchase?.variants]||1)};document.addEventListener("DOMContentLoaded",(function(){const t=document.querySelector(".bpllch5ap_license_popup");new e(t,{products:["h5ap","h5app","h5ap2"],prefix:"bpllch5ap",info:bpllch5ap,db:"h5ap"})}))})();
//# sourceMappingURL=license.js.map