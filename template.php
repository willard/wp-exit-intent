<div x-data="modal()" x-init="listen()">
    <div x-show.transition.opacity="open" x-on:click.away="open = false"
        class="p-4 fixed flex justify-center items-center inset-0 bg-black bg-opacity-75 z-50">
        <div x-show.transition="open"
            class="container max-w-3xl max-h-full bg-white rounded-xl shadow-lg overflow-auto">
            <div class="px-8 py-4 border-b border-black">
                <h2>Header</h2>
            </div>
            <div class="px-8 py-4">
                <p>Body</p>
            </div>
            <div class="px-8 py-4 border-t border-black text-center">
                <button x-on:click.prevent="open = false"
                    class="py-2 px-4 rounded-full text-center inline-block border border-black text-black bg-white hover:bg-black hover:text-white focus:outline-none">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
	function modal(){
		return {
			open: false,
			listen() {
				document.addEventListener("mouseleave", (event) => {
					var cookieIsSet = Cookies.get('exit_intent');
					if(cookieIsSet == undefined){
						Cookies.set('exit_intent', 'yes', { expires: 60 });
						this.open = true;
					}
				})
			}
		}
	}
</script>