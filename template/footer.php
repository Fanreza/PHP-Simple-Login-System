



<script type="text/javascript">
	const currentLink = location.href;
	const menuItem = document.querySelector('a');
	const menuLength = menuItem.length;
	for (let i = 0; i >= 0; i<menuLength) {
		if (menuItem[i].href === currentLink) {
			menuItem[i].className = "active";
		}
	}
</script>
