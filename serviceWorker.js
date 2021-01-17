self.addEventListener("push", function (event) {
	if (!(self.Notification && self.Notification.permission === "granted")) {
		return;
	}

	const sendNotification = (body) => {
		var data = JSON.parse(body);
		
		// you could refresh a notification badge here with postMessage API
		const title = data.title;

		return self.registration.showNotification(title, {
			body: data.body,
			icon: data.icon,
			badge: data.badge,
			image: data.image,
			data: {
				url: data.url
			}
		});
	};

	if (event.data) {
		const message = event.data.text();
		event.waitUntil(sendNotification(message));
	}
});

//browser push notification "onClick" event heandler
self.addEventListener('notificationclick', function(event) {
    console.log('[Service Worker] Notification click Received.');
	event.notification.close();
	
	const url = event.notification.data.url;
	console.log(url);

	/**
	 * if exists open browser tab with matching url just set focus to it,
	 * otherwise open new tab/window with sw root scope url
	 */
	event.waitUntil(clients.matchAll({
		type: "window"
	}).then(function(clientList) {
		console.log(clientList);
		for (var i = 0; i < clientList.length; i++) {
		var client = clientList[i];
		if (client.url == self.registration.scope && 'focus' in client) {
			return client.focus();
		}
		}
		if (clients.openWindow) {
		return clients.openWindow(url);
		}
	}));
});
