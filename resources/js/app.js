import './bootstrap';

if (layout == 'admin') {

    var channel = window.Echo.private('admins.' + adminId).notification((event) => {
        let url = showOrderRoute.replace(':id', event.order_id) + '?notify_admin=' + event.id;

        $('#pusherRealTime').prepend(` <a href="${url}">
                    <div class="media">
                      <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                      <div class="media-body">
                        <h6 class="media-heading">${event.message}</h6>
                        <p class="notification-text font-small-3 text-muted">
                          Order From ${event.user_name} -
                          EGP ${event.total_price}
                        </p>
                        <small>
                          <time class="media-meta text-muted" datetime="${event.created_at}">
                            ${event.created_at}</time>
                        </small>
                      </div>
                    </div>
                  </a>`);

        count = Number($('#notification_count').text());
        $('#notification_count').text(count+1); 
        
        count = Number($('#notification_count_inside').text());
        $('#notification_count_inside').text(count+1);
    }); 

}

// import './bootstrap';
// import Echo from 'laravel-echo';
// import Pusher from 'pusher-js';

// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: '99f5e74c14314b6979fa',
//     cluster: 'eu',
//     forceTLS: true
// });


// document.addEventListener('DOMContentLoaded', () => {
//     console.log('DOM fully loaded');

//     // Ensure adminId is defined
//     const adminId = window.adminId;
//     if (!adminId) {
//         console.error('Admin ID not found');
//         return;
//     }

//     // Ensure showOrderRoute is defined
//     if (!window.showOrderRoute) {
//         console.error('showOrderRoute not found');
//         return;
//     }

//     console.log('Subscribing to channel: admins.' + adminId);

//     window.Echo.private('admins.' + adminId)
//         .listen('.CreateOrderNotification', (event) => {
//             console.log('📬 New order notification:', event);

//             // Generate the notification HTML
//             const url = showOrderRoute.replace(':id', event.order_id) + '?notify_admin=' + event.id;
//             const newNotification = `
//                 <a class="dropdown-item" href="${url}">
//                     <div class="media">
//                         <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
//                         <div class="media-body">
//                             <h6 class="media-heading">${event.message}</h6>
//                             <p class="notification-text font-small-3 text-muted">
//                                 Order From ${event.user_name} - EGP ${event.total_price}
//                             </p>
//                             <small>
//                                 <time class="media-meta text-muted" datetime="${event.created_at}">
//                                     ${event.created_at}
//                                 </time>
//                             </small>
//                         </div>
//                     </div>
//                 </a>
//             `;

//             // Add notification to #pusherRealTime
//             const notifyPush = document.getElementById('pusherRealTime');
//             if (notifyPush) {
//                 notifyPush.insertAdjacentHTML('afterbegin', newNotification);
//                 console.log('Notification added to #pusherRealTime');
//             } else {
//                 console.error('Element #pusherRealTime not found');
//             }

//             // Update notification count badge
//             const badge = document.querySelector('#notification_count');
//             if (badge) {
//                 const currentCount = parseInt(badge.textContent) || 0;
//                 badge.textContent = currentCount + 1;
//                 badge.style.display = 'block';
//                 console.log('Badge updated to:', badge.textContent);
//             } else {
//                 console.error('Element #notification_count not found');
//             }

//             // Update notification count inside dropdown
//             const countElement = document.getElementById('notification_count_inside');
//             if (countElement) {
//                 const currentCount = parseInt(countElement.textContent) || 0;
//                 countElement.textContent = currentCount + 1;
//                 console.log('Count updated to:', countElement.textContent);
//             } else {
//                 console.error('Element #notification_count_inside not found');
//             }
//         });
// });