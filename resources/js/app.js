import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.Echo.private('App.Models.User.' + userId)
.notification(function(data){
alert(data.body)

let count = Number(document.getElementById('nm-count').innerText)
document.getElementById('nm-count').innerText = count + 1


const listElm = document.getElementById('nm-list')
listElm.innerHTML =  `<li><a class="dropdown-item" href="${date.url}?notify_id=${data.id}">
                    <h6>${data.title}</h6>
                    <p>${data.body}</p>
                    <p class="text-muted">${(new Date).toLocaleTimeString()}</p>
                    </a></li>` +  listElm.innerHTML;
});