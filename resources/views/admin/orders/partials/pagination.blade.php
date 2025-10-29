<div class="pagination">
    {{ $orders->appends(request()->query())->links() }}
    
    {{-- Note: The surrounding .pagination wrapper enables AJAX interception in admin/orders/index.blade.php --}}
</div>
