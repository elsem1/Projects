<div class="w-full md:w-3/4">

    <div class="border-t pt-4">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Bids</h2>

        <ul class="space-y-4">
            @foreach ($ad->bids as $bid)
                <li class="p-4 border rounded-lg bg-gray-100 hover:bg-gray-200 transition duration-200">
                    <div class="flex justify-between items-center">
                        <div>
                            <strong class="text-lg text-gray-800">€{{ $bid->bid }}</strong>
                            <p class="text-sm text-gray-600">By <span class="font-semibold">{{ $bid->user->name }}</span>
                            </p>
                        </div>
                        <div class="text-sm text-gray-400">
                            <i>{{ $bid->created_at->diffForHumans() }}</i>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>


    </div>
    <form id="bid-form" action="{{ route('ads.bids.store', $ad->id) }}" method="POST">
        @csrf
        <div class="mt-20 mb-3">
            <input type="number" min="0.00" max="10000.00" step="0.01" name="bid"
                class="fs-6 form-control w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700"
                placeholder="Bid an amount in €"></input>
        </div>
        <div>
            <button type="button"
                class="mt-6 bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition duration-200 btn-bid">
                Place a Bid
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector(".btn-bid").addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: "Are you sure you want to make this bid?",
                text: "You won't be able to revert this, the bid is final!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, place bid!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("bid-form").submit();
                }
            });
        });
    });
</script>
