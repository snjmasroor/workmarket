@extends('layouts.backend.master') 

@push('styles')
@endpush


@section('page-content')

<div id="card-fields-container" class="my-4">
    <div id="card-number" class="mb-3"></div>
    <div id="cvv" class="mb-3"></div>
    <div id="expiration-date" class="mb-3"></div>
</div>

<div id="card-errors" class="text-danger"></div>

<button id="pay-button" class="btn btn-primary" disabled>Pay {{ $data['totalJobPostingFees'] ?? '200.00' }}</button>
@endsection 
      
@push('scripts')
      <!-- DataTables -->
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&components=card-fields&intent=authorize"></script>


<!-- Main JS -->

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const cardFields = paypal.CardFields({
        createOrder: () => {
            return fetch("{{ route('paypal.order.create') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    amount: "{{ $data['totalJobPostingFees'] ?? '200.00' }}"
                })
            }).then(res => res.json()).then(order => order.id);
        },
        onApprove: (data) => {
            fetch(`/paypal/order/${data.orderID}/capture`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            }).then(res => res.json()).then(result => {
                if (result.success) {
                    alert("Payment successful!");
                    location.reload();
                } else {
                    alert("Payment failed.");
                }
            });
        },
        onError: err => {
            console.error(err);
            document.getElementById("card-errors").innerText = err.message || "Payment error occurred";
        },
        fields: {
            number: { selector: "#card-number" },
            cvv: { selector: "#cvv" },
            expirationDate: { selector: "#expiration-date" }
        },
        style: {
            input: {
                "font-size": "16px",
                "color": "#3A3A3A"
            }
        }
    });

    if (cardFields.isEligible()) {
        cardFields.render("#card-fields-container").then(() => {
            document.getElementById("pay-button").disabled = false;
            document.getElementById("pay-button").addEventListener("click", () => {
                cardFields.submit({ contingencies: ["3D_SECURE"] });
            });
        });
    } else {
        document.getElementById("card-fields-container").innerHTML = "<p>Card fields not eligible for this browser or user.</p>";
    }
});
</script>


@endpush