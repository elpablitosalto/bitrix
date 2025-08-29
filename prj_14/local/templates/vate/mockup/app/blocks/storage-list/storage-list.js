(function storageList() {
	var storages = document.querySelectorAll('.storage-list__item')

	function update(items) {
		console.log(update);
		if (items) {
			let arrStoreges = Array.from(items)
			let checkedItems = [];
			arrStoreges.forEach(storage => {
				let checkbox = storage.querySelector('.storage-list__checkbox')
				if (checkbox.checked) {
					checkedItems.push(storage)
				}
			})
			console.log(checkedItems);
		}
	}

	window.addEventListener('click', function (e) {
		if (e.target.closest('.storage-list__item')) {
			console.log(click);
			update(storages)
		}
	});
})();
