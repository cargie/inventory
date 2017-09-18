
{{-- <li class="{{ Request::is('addresses*') ? 'active' : '' }}">
    <a href="{!! route('addresses.index') !!}"><i class="fa fa-edit"></i><span>Addresses</span></a>
</li> --}}
<li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
	<a href="/dashboard">
		<i class="fa fa-dashboard"></i><span>Dashboard</span>
	</a>
</li>

<li class="{{ Request::is('orders*') ? 'active' : '' }}">
    <a href="{!! route('orders.index') !!}"><i class="fa fa-shopping-basket"></i><span>Orders</span></a>
</li>

<li class="{{ Request::is('payments*') ? 'active' : '' }}">
    <a href="{!! route('payments.index') !!}"><i class="fa fa-money"></i><span>Payments</span></a>
</li>

<li class="{{ Request::is('customers*') ? 'active' : '' }}">
    <a href="{!! route('customers.index') !!}"><i class="fa fa-users"></i><span>Customers</span></a>
</li>

<li class="treeview
	{{ Request::is('products*') ||
	   Request::is('categories*') ||
	   Request::is('tags*') ||
	   Request::is('suppliers*') ||
	   Request::is('inventories*') ||
	   Request::is('stock-adjustments*') ? 'active' : '' }}">
	<a href=""><i class="fa fa-cogs"></i>
		<span>Inventory &amp; Setup</span>
		<span class="pull-right-container">
        	<i class="fa fa-angle-left pull-right"></i>
      	</span>
	</a>
	<ul class="treeview-menu">
		<li class="{{ Request::is('inventories*') ? 'active' : '' }}">
		    <a href="{!! route('inventories.index') !!}"><i class="fa fa-archive"></i><span>Inventory</span></a>
		</li>

		<li class="{{ Request::is('stock-adjustments*') ? 'active' : '' }}">
		    <a href="{!! route('stock-adjustments.index') !!}"><i class="fa fa-edit"></i><span>Stock Adjustments</span></a>
		</li>

		<li class="{{ Request::is('products*') ? 'active' : '' }}">
		    <a href="{!! route('products.index') !!}"><i class="fa fa-product-hunt"></i><span>Products</span></a>
		</li>

		<li class="{{ Request::is('categories*') ? 'active' : '' }}">
		    <a href="{!! route('categories.index') !!}"><i class="fa fa-folder"></i><span>Categories</span></a>
		</li>

		<li class="{{ Request::is('tags*') ? 'active' : '' }}">
		    <a href="{!! route('tags.index') !!}"><i class="fa fa-tags"></i><span>Tags</span></a>
		</li>

		<li class="{{ Request::is('suppliers*') ? 'active' : '' }}">
		    <a href="{!! route('suppliers.index') !!}"><i class="fa fa-user-plus"></i><span>Suppliers</span></a>
		</li>
	</ul>
</li>
