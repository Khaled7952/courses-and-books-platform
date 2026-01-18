@foreach($meals as $meal)
  <div class="mx-4 ms-0">
    <div class="p-2 mb-5 border-2 card card-body rounded-4">
      <div class="mb-3 card-image">
        <img class="img-fluid rounded-4 w-100"
             src="{{ asset('uploads/meals/' . $meal->image) }}"
             alt="{{ $meal->name }}">
      </div>

      <div class="card-content">
        <h5 class="mb-4 text-dark">
          {{ $meal->name }}
          <span class="{{ app()->getLocale() == 'ar' ? 'float-end' : 'float-start' }}">
            <span class="p-2 badge bg-primary-20 text-dark rounded-pill fs-small fw-normal">
              <span id="is_number">{{ $meal->calories }}</span> {{ __('website.calories') }}
            </span>
          </span>
        </h5>

        <p class="fs-6">
          {{ $meal->description }}
        </p>

        <ul class="gap-2 mt-0 mb-0 list-inline ms-1 d-flex"
         @if(app()->getLocale() == 'en') style="justify-content: flex-start;"
        @endif>
          <li class="list-inline-item fs-6 li-item li-item01">
            <span id="is_number"> {{ $meal->protein }}</span>G {{ __('website.protein') }}
          </li>
          <li class="list-inline-item fs-6 li-item li-item02">
            <span id="is_number">{{ $meal->carbs }}</span>G {{ __('website.carbs') }}
          </li>
          <li class="list-inline-item fs-6 li-item li-item03">
           <span id="is_number"> {{ $meal->fat }}</span>G {{ __('website.fat') }}
          </li>
        </ul>
      </div>
    </div>
  </div>
@endforeach
