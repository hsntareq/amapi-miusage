const i=async(t,a=null,n="POST")=>{const e=new FormData;e.append("action",t),e.append("nonce",amapi_data.nonce),e.append("data",JSON.stringify(a));const o=await fetch(amapi_data.ajaxurl,{method:n,body:e});if(!o.ok)throw new Error("Network response was not ok");return o.json()};console.log("ajax-action.js");document.addEventListener("DOMContentLoaded",async()=>{const t=document.getElementById("amapi_refresh_button"),a=document.getElementById("amapi-page-content");d(a),t&&t.addEventListener("click",async()=>{d(a)})});function d(t){s(t),i("amapi_refresh_data",{name:"John Doe"}).then(a=>{t.innerHTML=r(JSON.parse(a.data))})}function s(t){t.innerHTML="";const a=document.createElement("img");a.src=amapi_data.loading_inline,a.alt="Loading...",t.appendChild(a)}const r=t=>(console.log(t.data.rows),` <table class="wp-list-table widefat fixed striped table-view-list datas amapi-datatable">
			<caption>${t.title}</caption>
			<thead>
				<tr>
				${t.data.headers.map(n=>`<th>${n}</th>`).join("")}
				</tr>
			</thead>
			<tbody>
				${Object.keys(t.data.rows).map(n=>{const e=t.data.rows[n];return`<tr>
						<td>${e.id}</td>
						<td>${e.fname}</td>
						<td>${e.lname}</td>
						<td>${e.email}</td>
						<td>${new Date(e.date*1e3).toLocaleDateString()}</td>
					</tr>`}).join("")}
			</tbody>
		</table>`);
