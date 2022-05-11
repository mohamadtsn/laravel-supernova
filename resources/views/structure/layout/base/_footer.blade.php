{{-- Footer --}}
<div class="footer bg-white pb-4 d-flex flex-lg-column pt-3 {{ Supernova::printClasses('footer', false) }}" id="kt_footer">
    {{-- Container --}}
    <div class="{{ Supernova::printClasses('footer-container', false) }} d-flex flex-column flex-md-row align-items-center justify-content-between">
        {{-- Copyright --}}
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted font-weight-bold mr-2">&copy;&nbsp;{{ date("Y") }}</span>
            <span>
                توسعه داده شده توسط <a href="https://github.com/mohamadtsn/" target="_blank" class="text-dark-75 text-hover-primary">mohamadtsn@</a> با <i title="Love" data-theme="dark" data-toggle="tooltip" class="fa fa-heart text-danger"></i>
            </span>
        </div>

        {{-- Nav --}}
        <div class="nav nav-dark order-1 order-md-2">
            <a href="https://github.com/mohamadtsn/" target="_blank" class="nav-link pr-3 pl-0"><i class="fab fa-github text-dark fa-2x"></i></a>
        </div>
    </div>
</div>
