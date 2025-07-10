<div class="content container-fluid text-center" style="min-height: 70vh; display: flex; justify-content: center; align-items: center;">
    <div class="card p-5 shadow" style="max-width: 450px; width: 100%; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.12); background: #fff;">
        <h2 class="text-success" style="font-size: 2.5rem; margin-bottom: 1rem;">🎉 Payment Successful!</h2>
        <p class="mt-2" style="font-size: 1.125rem; color: #444;">You have successfully completed the payment.</p>
        <p class="text-muted" style="color: #666; margin-bottom: 2rem;">Redirecting you shortly...</p>
        <a href="{{ route('vendor.featured-product.index', ['promotionId' => $promotionId]) }}" class="btn btn-primary mt-3" style="padding: 12px 24px; font-size: 1.1rem; border-radius: 6px; text-decoration: none; color: #fff; background-color: #007bff; display: inline-block; transition: background-color 0.3s ease;">
            Go Back
        </a>
    </div>
</div>

<script>
    const redirectUrl = "{{ route('vendor.featured-product.index', ['promotionId' => $promotionId]) }}";

    if (window.parent !== window) {
        // If inside iframe, redirect parent window immediately
        window.parent.location.href = redirectUrl;
    } else {
        // If in main window, redirect after 5 seconds
        setTimeout(() => {
            window.location.href = redirectUrl;
        }, 5000);
    }
</script>
