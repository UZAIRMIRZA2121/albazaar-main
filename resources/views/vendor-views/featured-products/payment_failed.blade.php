<div class="content container-fluid" style="min-height: 70vh; display: flex; justify-content: center; align-items: center;">
    <div class="card p-5 shadow" style="max-width: 450px; width: 100%; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.12); background: #fff;">
        <div class="card-body text-center">
            <h2 class="text-danger" style="font-size: 2.5rem; margin-bottom: 1rem;">❌ Payment Failed</h2>
            <p style="font-size: 1.125rem; color: #444; margin-bottom: 2rem;">{{ $message }}</p>
            <a href="{{ route('vendor.featured-product.index') }}" class="btn btn-danger" style="padding: 12px 24px; font-size: 1.1rem; border-radius: 6px; color: #fff; background-color: #dc3545; text-decoration: none; display: inline-block; transition: background-color 0.3s ease;">
                Try Again
            </a>
        </div>
    </div>
</div>

<script>
    const redirectUrl = "{{ route('vendor.featured-product.index') }}";

    if (window.parent !== window) {
        // If inside iframe, redirect parent immediately
        window.parent.location.href = redirectUrl;
    } else {
        // Otherwise redirect after 5 seconds
        setTimeout(() => {
            window.location.href = redirectUrl;
        }, 5000);
    }
</script>
