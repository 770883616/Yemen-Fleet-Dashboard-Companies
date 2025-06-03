@extends('layouts.master')

@section('title', 'قائمة العملاء')

@section('content')
<div class="container">
    <h1>قائمة العملاء</h1>

    <form method="GET" action="{{ route('customers.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="بحث بالاسم" value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="address" class="form-control" placeholder="تصفية حسب العنوان" value="{{ request('address') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">بحث</button>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">إعادة تعيين</a>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>الهاتف</th>
                <th>البريد الإلكتروني</th>
                <th>العنوان</th>

            </tr>
        </thead>
        <tbody>
            @forelse($customers as $index => $customer)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $customer->customer_name }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->address }}</td>

                </tr>
            @empty
                <tr>
                    <td colspan="7">لا توجد بيانات لعرضها</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $customers->withQueryString()->links() }}
</div>
@endsection
