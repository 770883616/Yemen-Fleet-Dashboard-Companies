<!-- resources/views/pages/Orders/assign-driver-modal.blade.php -->
<div class="modal fade" id="assignDriverModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="POST" action="{{ route('orders.assignDriver', $order->id) }}">
        @csrf
        <div class="modal-header"><h5 class="modal-title">تعيين سائق</h5></div>
        <div class="modal-body">
          <div class="row">
            @foreach($drivers as $driver)
              <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <h5>{{ $driver->driver_name }}</h5>
                    <p>{{ $driver->phone }}</p>
                    <button type="submit" name="driver_id" value="{{ $driver->id }}" class="btn btn-success btn-block">تعيين</button>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
