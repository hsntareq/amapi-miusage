const l=async(n,a=null)=>{const t=new FormData;t.append("action",n),t.append("nonce",ec_data.nonce),t.append("data",JSON.stringify(a));const e=await fetch(ec_data.ajaxurl,{method:"POST",body:t});if(!e.ok)throw new Error("Network response was not ok");return e.json()},r=document.getElementById("calendar-body"),u=document.getElementById("calendar-heading");document.addEventListener("DOMContentLoaded",function(){function n(i,s){u.textContent=`${m(s)}, ${i}`,r.innerHTML='<tr><td colspan="7" style="text-align:center;"><span class="spinner is-active"></span></td></tr>',l("monthly_calendar_data",{year:i,month:s}).then(o=>{setTimeout(()=>{r.innerHTML=o},10)}).catch(o=>console.error("Error fetching calendar data:",o))}const a=new Date;let t=a.getFullYear(),e=a.getMonth()+1;r&&n(t,e);let c=document.getElementById("next-button");c&&c.addEventListener("click",function(){e++,e>12&&(e=1,t++),n(t,e)});let d=document.getElementById("previous-button");d&&d.addEventListener("click",function(){e--,e<1&&(e=12,t--),n(t,e)})});function m(n){var a=["January","February","March","April","May","June","July","August","September","October","November","December"];return n<1||n>12?"Invalid Month":a[n-1]}