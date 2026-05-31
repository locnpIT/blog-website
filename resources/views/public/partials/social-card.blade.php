<section class="sidebar-card">
    <h3>Kết nối với mình</h3>
    <div class="social-row">
        @if($globalSettings['social_facebook'] ?? '')
            <a href="{{ $globalSettings['social_facebook'] }}" target="_blank" rel="noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        @endif
        @if($globalSettings['social_instagram'] ?? '')
            <a href="{{ $globalSettings['social_instagram'] }}" target="_blank" rel="noreferrer" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        @endif
        @if($globalSettings['social_pinterest'] ?? '')
            <a href="{{ $globalSettings['social_pinterest'] }}" target="_blank" rel="noreferrer" aria-label="Pinterest"><i class="fab fa-pinterest-p"></i></a>
        @endif
        @if($globalSettings['social_email'] ?? '')
            <a href="mailto:{{ $globalSettings['social_email'] }}" aria-label="Email"><i class="far fa-envelope"></i></a>
        @endif
    </div>
</section>
