<style>
	.v-select {
		margin-bottom: 5px;
		background: #fff;
	}

	.v-select .dropdown-toggle {
		padding: 0px;
		border-radius: 0;
	}

	.v-select input[type=search],
	.v-select input[type=search]:focus {
		margin: 0px;
	}

	.v-select .vs__selected-options {
		overflow: hidden;
		flex-wrap: nowrap;
	}

	.v-select .selected-tag {
		margin: 2px 0px;
		white-space: nowrap;
		position: absolute;
		left: 0px;
	}

	.v-select .vs__actions {
		margin-top: -5px;
	}

	.v-select .dropdown-menu {
		width: auto;
		overflow-y: auto;
	}

	#branchDropdown .vs__actions button {
		display: none;
	}

	#branchDropdown .vs__actions .open-indicator {
		height: 15px;
		margin-top: 7px;
	}

	@media screen and (max-width: 600px) and (min-width: 320px) {
		.paddingMobile {
			padding-left: 12px !important;
			padding-right: 12px !important;
		}

	}

	.widget-body {
		background: #d5d2d2;
	}
</style>

<div id="sales" class="row" style="background:#d5d2d2;padding-bottom:50px;">
	<div class="col-xs-12 col-md-12 col-lg-12">
		<div class="widget-box" style="border: 2px solid gray;">
			<div class="widget-main">
				<div class="widget-body">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group row">
								<label class="col-xs-4 col-md-3 control-label no-padding-right"> Sales From </label>
								<div class="col-xs-8 col-md-9">
									<v-select id="branchDropdown" disabled v-bind:options="branches" label="Brunch_name" v-model="selectedBranch"></v-select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-xs-4 col-md-3 control-label no-padding-right"> Customer </label>
								<div class="col-xs-7 col-md-8 no-padding-right">
									<v-select v-bind:options="customers" label="display_name" v-model="selectedCustomer" v-on:input="customerOnChange"></v-select>
								</div>
								<div class="col-xs-1 col-md-1">
									<a href="<?= base_url('customer') ?>" class="btn btn-xs btn-danger" style="height: 25px; border: 0; width: 27px; margin-left: -10px;" target="_blank" title="Add New Customer"><i class="fa fa-plus" aria-hidden="true" style="margin-top: 5px;"></i></a>
								</div>
							</div>

							<div class="form-group row" style="display:none;" v-bind:style="{display: selectedCustomer.Customer_Type == 'G' || selectedCustomer.Customer_Type == 'N' ? '' : 'none'}">
								<label class="col-xs-4 col-md-3 control-label no-padding-right"> Name </label>
								<div class="col-xs-8 col-md-9">
									<input type="text" id="customerName" placeholder="Customer Name" class="form-control" v-model="selectedCustomer.Customer_Name" v-bind:disabled="selectedCustomer.Customer_Type == 'G' || selectedCustomer.Customer_Type == 'N' ? false : true" />
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xs-4 col-md-3 control-label no-padding-right"> Mobile No </label>
								<div class="col-xs-8 col-md-9">
									<input type="text" id="mobileNo" placeholder="Mobile No" class="form-control" v-model="selectedCustomer.Customer_Mobile" v-bind:disabled="selectedCustomer.Customer_Type == 'G' || selectedCustomer.Customer_Type == 'N' ? false : true" />
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xs-4 col-md-3 control-label no-padding-right"> Address </label>
								<div class="col-xs-8 col-md-9">
									<textarea id="address" placeholder="Address" class="form-control" v-model="selectedCustomer.Customer_Address" v-bind:disabled="selectedCustomer.Customer_Type == 'G' || selectedCustomer.Customer_Type == 'N' ? false : true"></textarea>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group row">
								<label class="col-xs-4 control-label no-padding-right"> Last Invoice </label>
								<div class="col-xs-8">
									<input type="text" id="invoiceNo" class="form-control" v-model="sales.invoiceNo" readonly />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-xs-4 control-label no-padding-right"> Sales By </label>
								<div class="col-xs-8">
									<v-select v-bind:options="employees" v-model="selectedEmployee" label="Employee_Name" placeholder="Select Employee"></v-select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-xs-4 control-label no-padding-right"> Sales Date </label>
								<div class="col-xs-8">
									<input class="form-control" id="salesDate" type="date" v-model="sales.salesDate" v-bind:disabled="userType == 'u' ? true : false" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- background: #d3cccc; -->
		<div class="widget-box" style="border: 2px solid gray;">
			<div class="widget-main" style="padding: 5px;">
				<div class="widget-body">
					<form @submit.prevent="addToCart">
						<div class="row">
							<div class="col-xs-12 col-md-1 no-padding-right paddingMobile">
								<div class="form-group">
									<label for="">Item No</label>
									<input type="text" readonly v-model="selectedProduct.Product_Code" name="productCode" class="form-control" style="border-radius:0 !important;height:27px;">
								</div>
							</div>
							<div class="col-xs-12 col-md-2 no-padding paddingMobile">
								<div class="form-group">
									<label for="">Product Name</label>
									<v-select :options="products" id="products" v-model="selectedProduct" label="display_text" @input="productOnChange" @search="productSearch"></v-select>
								</div>
							</div>
							<div class="col-xs-12 col-md-1 no-padding paddingMobile">
								<div class="form-group">
									<label for="">Genetic</label>
									<input type="text" readonly v-model="selectedProduct.genetic_name" class="form-control" style="border-radius:0 !important;height:27px;">
								</div>
							</div>
							<div class="col-xs-12 col-md-1 no-padding paddingMobile">
								<div class="form-group">
									<label for="">Type</label>
									<input type="text" readonly v-model="selectedProduct.ProductCategory_Name" class="form-control" style="border-radius:0 !important;height:27px;">
								</div>
							</div>
							<div class="col-xs-12 col-md-1 no-padding paddingMobile">
								<div class="form-group">
									<label for="">Stock</label>
									<input type="text" v-model="quantityText" readonly class="form-control" style="border-radius:0 !important;height:27px;">
								</div>
							</div>
							<div class="col-xs-12 col-md-2 no-padding paddingMobile">
								<div class="form-group">
									<label for=""> Exp. Date </label>
									<v-select v-bind:options="dateStock" id="dateStock" v-model="selectedExpStock" label="expire_date" @input=dateOnChange></v-select>
								</div>
							</div>
							<div class="col-xs-12 col-md-1 no-padding paddingMobile">
								<div class="form-group">
									<label for="">Sale Rate</label>
									<input type="text" id="saleRate" ref="saleRate" v-model="selectedProduct.Product_SellingPrice" @input="productTotal" class="form-control" style="border-radius:0 !important;height:27px;">
								</div>
							</div>
							<div class="col-xs-12 col-md-1 no-padding paddingMobile">
								<div class="form-group">
									<label for="">Quantity</label>
									<input type="text" id="quantity" ref="quantity" v-model="selectedProduct.qty" class="form-control" style="border-radius:0 !important;height:27px;" @input="productTotal">
								</div>
							</div>
							<div class="col-xs-12 col-md-1 no-padding paddingMobile">
								<div class="form-group">
									<label for="">Conv. Qty</label>
									<input type="text" id="unitQty" ref="unitQty" v-model="selectedProduct.unitQty" class="form-control" style="border-radius:0 !important;height:27px;" @input="productTotal">
								</div>
							</div>
							<div class="col-xs-12 col-md-1" style="margin-top: 25px;">
								<div class="form-group">
									<button style="width: 100%;" type="submit">Add</button>
								</div>
							</div>
						</div>
					</form>
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered" style="color:#000;margin-bottom: 5px;">
									<thead>
										<tr style="background: #d5d2d2;">
											<th style="width:5%;color:#000;">Sl</th>
											<th style="width:12%;color:#000;">Product Code</th>
											<th style="width:20%;color:#000;">Product Name</th>
											<th style="width:15%;color:#000;">Category</th>
											<th style="width:17%;color:#000;">Quantity</th>
											<th style="width:11%;color:#000;">Rate</th>
											<th style="width:12%;color:#000;">Total Amount</th>
											<th style="width:8%;color:#000;">Action</th>
										</tr>
									</thead>
									<tbody style="display:none;background:#fff;" v-bind:style="{display: cart.length > 0 ? '' : 'none'}">
										<tr v-for="(product, sl) in cart" style="background: #6fffff;">
											<td>{{ sl + 1 }}</td>
											<td>{{ product.productCode }}</td>
											<td>{{ product.name }}</td>
											<td>{{ product.categoryName }}</td>
											<td>{{ product.quantity_text }}</td>
											<td>{{ product.salesRate }}</td>
											<td>{{ product.total }}</td>
											<td><a href="" v-on:click.prevent="removeFromCart(sl)"><i class="fa fa-trash"></i></a></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-8 col-lg-8">
		<div class="widget-box" style="border: 2px solid gray;">
			<div class="widget-main" style="padding: 5px;">
				<div class="widget-body">
					<div class="row">
						<div class="col-xs-12 no-padding paddingMobile">
							<div class="table-responsive">
								<table style="color:#000;margin-bottom: 0px;border-collapse: collapse;width:100%;">
									<tr style="display:none;">
										<td>
											<div class="form-group">
												<label class="col-xs-12 control-label no-padding-right">Round Of</label>
												<div class="col-xs-12">
													<input type="number" id="roundOf" class="form-control" />
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<label class="col-xs-4 col-md-3 control-label no-padding-right">Discount</label>

												<div class="col-xs-3 col-md-3 no-padding">
													<input type="number" id="discountPercent" class="form-control" v-model="discountPercent" v-on:input="calculateTotal" />
												</div>

												<label class="col-xs-1 col-md-1 control-label no-padding-left">%</label>

												<div class="col-xs-4 col-md-5 no-padding-left">
													<input type="number" id="discount" class="form-control" v-model="sales.discount" v-on:input="calculateTotal" />
												</div>

											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<label class="col-xs-4 col-md-3 control-label no-padding-right">Payment Type</label>
												<div class="col-xs-8 col-md-4 no-padding-left">
													<select class="form-control" v-model="sales.payment_type" style="padding: 0px;border-radius: 3px;">
														<option value="cash">Cash</option>
														<option value="bank">Bank</option>
													</select>
												</div>
												<label class="col-xs-4 col-md-1 control-label no-padding-right">Paid</label>
												<div class="col-xs-8 col-md-4 no-padding-left">
													<input type="number" id="paid" class="form-control" v-model="sales.paid" v-on:input="calculateTotal" v-bind:disabled="selectedCustomer.Customer_Type == 'G' ? true : false" />
												</div>
											</div>
										</td>
									</tr>

									<tr style="display: none;" :style="{display: sales.payment_type == 'bank' ? '' : 'none'}">
										<td>
											<div class="form-group">
												<label class="col-xs-4 col-md-3 control-label no-padding-right">Bank Account</label>
												<div class="col-xs-8 col-md-9 no-padding-left">
													<v-select v-bind:options="accounts" v-model="selectedAccount" label="display_text" placeholder="Select account"></v-select>
												</div>
											</div>
										</td>
									</tr>

									<tr>
										<td>
											<div class="form-group">
												<label class="col-xs-4 col-md-3 control-label no-padding-right">Due</label>
												<div class="col-xs-4 col-md-4 no-padding-left">
													<input type="number" id="due" class="form-control" v-model="sales.due" readonly />
												</div>
												<div class="col-xs-4 col-md-5 no-padding-left">
													<input type="number" id="previousDue" class="form-control" v-model="sales.previousDue" readonly style="color:red;" />
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<label class="col-xs-4 col-md-3 control-label no-padding-right">Remark</label>
												<div class="col-xs-8 col-md-9 no-padding-left">
													<textarea style="width: 100%;font-size:13px;" placeholder="Remark" v-model="sales.note"></textarea>
												</div>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-4 col-lg-4">
		<div class="widget-box" style="border: 2px solid gray;">
			<div class="widget-main" style="padding: 5px;">
				<div class="widget-body">
					<div class="row">
						<div class="col-xs-12 no-padding paddingMobile">
							<div class="table-responsive">
								<table style="color:#000;margin-bottom: 0px;border-collapse: collapse;width:100%;">
									<tr>
										<td>
											<div class="form-group">
												<label class="col-xs-4 col-md-3 control-label no-padding-right">Sub Total</label>
												<div class="col-xs-8 col-md-9 no-padding-left">
													<input type="number" id="subTotal" class="form-control" v-model="sales.subTotal" readonly />
												</div>
											</div>
										</td>
									</tr>

									<tr>
										<td>
											<div class="form-group">
												<label class="col-xs-4 col-md-3 control-label no-padding-right"> Vat </label>
												<div class="col-xs-8 col-md-9 no-padding-left">
													<input type="number" id="vat" readonly="" class="form-control" v-model="sales.vat" />
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<label class="col-xs-4 col-md-3 control-label no-padding-right">Transport</label>
												<div class="col-xs-8 col-md-9 no-padding-left">
													<input type="number" class="form-control" v-model="sales.transportCost" v-on:input="calculateTotal" />
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<label class="col-xs-4 col-md-3 control-label no-padding-right">Total</label>
												<div class="col-xs-8 col-md-9 no-padding-left">
													<input type="number" id="total" class="form-control" v-model="sales.total" readonly />
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<div class="col-xs-6">
													<input type="button" class="btn btn-default btn-sm" value="Sale" v-on:click="saveSales" v-bind:disabled="saleOnProgress ? true : false" style="color: black!important;margin-top: 0px;width:100%;padding:5px;font-weight:bold;">
												</div>
												<div class="col-xs-6">
													<a class="btn btn-info btn-sm" v-bind:href="`/sales/${sales.isService == 'true' ? 'service' : 'product'}`" style="color: black!important;margin-top: 0px;width:100%;padding:5px;font-weight:bold;">New Sale</a>
												</div>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url(); ?>assets/js/vue/vue.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/vue/axios.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/vue/vue-select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>

<script>
	Vue.component('v-select', VueSelect.VueSelect);
	new Vue({
		el: '#sales',
		data() {
			return {
				sales: {
					salesId: parseInt('<?php echo $salesId; ?>'),
					invoiceNo: '<?php echo $invoice; ?>',
					salesBy: '<?php echo $this->session->userdata("FullName"); ?>',
					salesType: 'retail',
					salesFrom: '',
					salesDate: '',
					customerId: '',
					employeeId: null,
					subTotal: 0.00,
					discount: 0.00,
					vat: 0.00,
					transportCost: 0.00,
					total: 0.00,
					paid: 0.00,
					previousDue: 0.00,
					due: 0.00,
					isService: '<?php echo $isService; ?>',
					note: '',
					payment_type: 'cash',
					accountId: null
				},
				vatPercent: 0,
				discountPercent: 0,
				cart: [],
				employees: [],
				selectedEmployee: null,
				branches: [],
				selectedBranch: {
					brunch_id: "<?php echo $this->session->userdata('BRANCHid'); ?>",
					Brunch_name: "<?php echo $this->session->userdata('Brunch_name'); ?>"
				},
				customers: [],
				selectedCustomer: {
					Customer_SlNo: '',
					Customer_Code: '',
					Customer_Name: '',
					display_name: 'Select Patient',
					Customer_Mobile: '',
					Customer_Address: '',
					Customer_Type: ''
				},
				oldCustomerId: null,
				oldPreviousDue: 0,
				categories: [],
				selectedCategory: {
					ProductCategory_SlNo: '',
					ProductCategory_Name: 'Select Category',
				},
				products: [],
				products2: [],
				selectedProduct: {
					Product_SlNo: '',
					display_text: 'Select Product',
					Product_Name: '',
					Unit_Name: '',
					quantity: 0,
					Product_Purchase_Rate: '',
					Product_SellingPrice: 0.00,
					vat: 0.00,
					total: 0.00,
					unitQty: 0,
					qty: 0,
					shelf: '',
					ProductCategory_Name: ''
				},
				productPurchaseRate: '',
				productStockText: '',
				productStock: '',
				dateStock: '',
				selectedExpStock: {
					expire_date: ''
				},
				quantityText: '',
				saleOnProgress: false,
				sales_due_on_update: 0,
				userType: '<?php echo $this->session->userdata("accountType"); ?>',
				accounts: [],
				selectedAccount: null,
				selectedResultIndex: 0,
			}
		},
		watch: {
			selectedAccount(account) {
				if (account == undefined) return;
				this.sales.accountId = account.account_id;
			}
		},
		async created() {
			this.sales.salesDate = moment().format('YYYY-MM-DD');
			await this.getEmployees();
			await this.getBranches();
			await this.getCustomers();
			await this.getAccounts();
			this.getProducts();
			if (this.sales.salesId != 0) {
				await this.getSales();
			}
		},
		methods: {
			productSearch(val) {
				if (val) {
					this.products = this.products2.filter(product => product.Product_Name.toLowerCase().startsWith(val))
				}
			},
			async getAccounts() {
				await axios.get('/get_bank_accounts')
					.then(res => {
						this.accounts = res.data.map((item, display_text) => {
							item.display_text = `${item.bank_name} - ${item.account_number}`;
							return item;
						});
					})
			},
			getEmployees() {
				axios.get('/get_employees').then(res => {
					this.employees = res.data;
				})
			},
			getBranches() {
				axios.get('/get_branches').then(res => {
					this.branches = res.data;
				})
			},
			async getCustomers() {
				await axios.post('/get_customers', {
					customerType: this.sales.salesType
				}).then(res => {
					this.customers = res.data;
					this.customers.unshift({
						Customer_SlNo: 'C01',
						Customer_Code: '',
						Customer_Name: '',
						display_name: 'Cash Patient',
						Customer_Mobile: '',
						Customer_Address: '',
						Customer_Type: 'N'
					})
					this.customers.unshift({
						Customer_SlNo: 'C01',
						Customer_Code: '',
						Customer_Name: '',
						display_name: 'General Patient',
						Customer_Mobile: '',
						Customer_Address: '',
						Customer_Type: 'G'
					})
				})
			},

			getProducts() {
				axios.post('/get_products', {
					isService: 'false',
				}).then(res => {
					this.products2 = res.data;
				})
			},

			productTotal() {
				let unitQty = this.selectedProduct.unitQty ? this.selectedProduct.per_unit * this.selectedProduct.unitQty : 0;
				let pcsQty = this.selectedProduct.qty ? this.selectedProduct.qty : 0;

				this.selectedProduct.quantity = parseFloat(unitQty) + parseFloat(pcsQty);
				this.selectedProduct.total = (parseFloat(this.selectedProduct.quantity) * parseFloat(this.selectedProduct.Product_SellingPrice)).toFixed(2);
			},
			onSalesTypeChange() {
				this.selectedCustomer = {
					Customer_SlNo: '',
					Customer_Code: '',
					Customer_Name: '',
					display_name: 'Select Patient',
					Customer_Mobile: '',
					Customer_Address: '',
					Customer_Type: ''
				}
				this.getCustomers();
				this.clearProduct();
				this.getProducts();
			},
			async customerOnChange() {
				if (this.selectedCustomer.Customer_SlNo == '') {
					return;
				}
				if (event.type == 'readystatechange') {
					return;
				}

				if (this.sales.salesId != 0 && this.oldCustomerId != parseInt(this.selectedCustomer.Customer_SlNo)) {
					let changeConfirm = confirm('Changing customer will set previous due to current due amount. Do you really want to change customer?');
					if (changeConfirm == false) {
						return;
					}
				} else if (this.sales.salesId != 0 && this.oldCustomerId == parseInt(this.selectedCustomer.Customer_SlNo)) {
					this.sales.previousDue = this.oldPreviousDue;
					return;
				}

				await this.getCustomerDue();

				this.calculateTotal();
			},
			async getCustomerDue() {
				await axios.post('/get_customer_due', {
					customerId: this.selectedCustomer.Customer_SlNo
				}).then(res => {
					if (res.data.length > 0) {
						this.sales.previousDue = res.data[0].dueAmount;
					} else {
						this.sales.previousDue = 0;
					}
				})
			},
			async productOnChange() {
				if (this.selectedProduct.Product_SlNo == '') {
					return;
				}
				if (this.selectedProduct.Product_SlNo == '' || this.selectedProduct == null) {
					this.selectedProduct = {
						Product_SlNo: '',
						display_text: 'Select Product',
						Product_Name: '',
						Unit_Name: '',
						quantity: 0,
						Product_Purchase_Rate: '',
						Product_SellingPrice: 0.00,
						vat: 0.00,
						total: 0.00,
						unitQty: 0,
						qty: 0,
						shelf: '',
						ProductCategory_Name: ''
					}
					return
				}

				if ((this.selectedProduct.Product_SlNo != '' || this.selectedProduct.Product_SlNo != 0) && this.sales.isService == 'false') {
					this.productStock = await axios.post('/get_product_stock', {
						productId: this.selectedProduct.Product_SlNo,
						expired_available: this.selectedProduct.expired_available
					}).then(res => {
						return res.data[0].current_quantity;
					})
					this.productStockText = this.productStock > 0 ? "Available Stock" : "Stock Unavailable";
					this.quantityText = this.selectedProduct.per_unit == 0 ? `${this.productStock} ${this.selectedProduct.Unit_Name}` : `${Math.floor(this.productStock / this.selectedProduct.per_unit)} ${this.selectedProduct.convert_text} ${this.productStock % this.selectedProduct.per_unit} ${this.selectedProduct.Unit_Name}`;
				}

				if ((this.selectedProduct.Product_SlNo != '' || this.selectedProduct.Product_SlNo != 0) && this.sales.isService == 'false') {
					this.dateStock = await axios.post('/get_available_date', {
						productId: this.selectedProduct.Product_SlNo,
						expired_available: this.selectedProduct.expired_available
					}).then(res => {
						return res.data.filter(item => item.current_quantity > 0);
					})
				}

				document.querySelector("#dateStock [type='search']").focus();
			},
			async dateOnChange() {
				if ((this.selectedProduct.Product_SlNo != '' || this.selectedProduct.Product_SlNo != 0) && this.sales.isService == 'false') {
					this.productStock = await axios.post('/get_product_stock', {
						productId: this.selectedProduct.Product_SlNo,
						expired_available: this.selectedProduct.expired_available,
						expiredDate: this.selectedExpStock.expire_date
					}).then(res => {
						return res.data[0].current_quantity;
					})
					this.productStockText = this.productStock > 0 ? "Available Stock" : "Stock Unavailable";
					this.quantityText = this.selectedProduct.per_unit == 0 ? `${this.productStock} ${this.selectedProduct.Unit_Name}` : `${Math.floor(this.productStock / this.selectedProduct.per_unit)} ${this.selectedProduct.convert_text} ${this.productStock % this.selectedProduct.per_unit} ${this.selectedProduct.Unit_Name}`;
				}
			},
			toggleProductPurchaseRate() {
				//this.productPurchaseRate = this.productPurchaseRate == '' ? this.selectedProduct.Product_Purchase_Rate : '';
				this.$refs.productPurchaseRate.type = this.$refs.productPurchaseRate.type == 'text' ? 'password' : 'text';
			},
			addToCart() {
				if (this.selectedProduct.expired_available == 1) {
					if (this.selectedExpStock.expire_date == "" || this.selectedExpStock.expire_date == null || this.selectedExpStock.expire_date == 0) {
						alert("Select Expire Date First!");
						return;
					}
				} else {
					this.selectedExpStock.expire_date = null;
				}

				let product = {
					productId: this.selectedProduct.Product_SlNo,
					productCode: this.selectedProduct.Product_Code,
					categoryName: this.selectedProduct.ProductCategory_Name,
					name: this.selectedProduct.Product_Name,
					salesRate: this.selectedProduct.Product_SellingPrice,
					vat: this.selectedProduct.vat,
					quantity: this.selectedProduct.quantity,
					total: this.selectedProduct.total,
					expireDate: this.selectedExpStock.expire_date,
					purchaseRate: this.selectedProduct.Product_Purchase_Rate,
					quantity_text: `${Math.floor(this.selectedProduct.quantity / this.selectedProduct.per_unit)} ${this.selectedProduct.convert_text} ${this.selectedProduct.quantity % this.selectedProduct.per_unit} ${this.selectedProduct.Unit_Name}`
				}

				if (product.productId == '') {
					alert('Select Product');
					return;
				}

				if (product.quantity == 0 || product.quantity == '' || product.quantity == null) {
					alert('Enter quantity');
					return;
				}

				if (product.salesRate == 0 || product.salesRate == '') {
					alert('Enter sales rate');
					return;
				}
				if (this.selectedCategory == null || this.selectedCategory == '') {
					alert('Select Category');
					return;
				}

				if (product.quantity > this.productStock && this.sales.isService == 'false') {
					alert('Stock unavailable');
					return;
				}

				let cartInd = this.cart.findIndex(p => p.productId == product.productId);
				if (cartInd > -1) {
					this.cart.splice(cartInd, 1);
				}

				this.cart.unshift(product);
				this.clearProduct();
				this.calculateTotal();
				document.querySelector("#products [type='search']").focus();
			},
			removeFromCart(ind) {
				this.cart.splice(ind, 1);
				this.calculateTotal();
			},
			clearProduct() {
				this.selectedProduct = {
					Product_SlNo: '',
					display_text: 'Select Product',
					Product_Name: '',
					Unit_Name: '',
					quantity: 0,
					Product_Purchase_Rate: '',
					Product_SellingPrice: 0.00,
					vat: 0.00,
					total: 0.00,
					unitQty: 0,
					qty: 0,
					shelf: '',
					ProductCategory_Name: ''
				}
				this.productStock = '';
				this.productStockText = '';
				this.quantityText = '';
				this.selectedExpStock = '';
			},
			calculateTotal() {
				this.sales.subTotal = this.cart.reduce((prev, curr) => {
					return prev + parseFloat(curr.total)
				}, 0).toFixed(2);
				this.sales.vat = this.cart.reduce((prev, curr) => {
					return +prev + +(curr.total * (curr.vat / 100))
				}, 0);
				if (event.target.id == 'discountPercent') {
					this.sales.discount = ((parseFloat(this.sales.subTotal) * parseFloat(this.discountPercent)) / 100).toFixed(2);
				} else {
					this.discountPercent = (parseFloat(this.sales.discount) / parseFloat(this.sales.subTotal) * 100).toFixed(2);
				}
				this.sales.total = ((parseFloat(this.sales.subTotal) + parseFloat(this.sales.vat) + parseFloat(this.sales.transportCost)) - parseFloat(this.sales.discount)).toFixed(2);
				if (this.selectedCustomer.Customer_Type == 'G') {
					this.sales.paid = this.sales.total;
					this.sales.due = 0;
				} else {
					if (event.target.id != 'paid') {
						this.sales.paid = 0;
					}
					this.sales.due = (parseFloat(this.sales.total) - parseFloat(this.sales.paid)).toFixed(2);
				}
			},
			async saveSales() {
				if (this.selectedCustomer.Customer_SlNo == '') {
					alert('Select Patient');
					return;
				}
				if (this.cart.length == 0) {
					alert('Cart is empty');
					return;
				}
				if (this.sales.payment_type == 'bank' && this.sales.accountId == null) {
					alert('Select bank account');
					return;
				}
				if (this.sales.payment_type == 'bank' && this.sales.paid == 0) {
					alert('Paid amount is required');
					return;
				}

				this.saleOnProgress = true;

				await this.getCustomerDue();

				let url = "/add_sales";
				if (this.sales.salesId != 0) {
					url = "/update_sales";
					this.sales.previousDue = parseFloat((this.sales.previousDue - this.sales_due_on_update)).toFixed(2);
				}

				if (parseFloat(this.selectedCustomer.Customer_Credit_Limit) < (parseFloat(this.sales.due) + parseFloat(this.sales.previousDue))) {
					alert(`Customer credit limit (${this.selectedCustomer.Customer_Credit_Limit}) exceeded`);
					this.saleOnProgress = false;
					return;
				}

				if (this.selectedEmployee != null && this.selectedEmployee.Employee_SlNo != null) {
					this.sales.employeeId = this.selectedEmployee.Employee_SlNo;
				} else {
					this.sales.employeeId = null;
				}
				this.sales.ProductCategory_ID = this.selectedCategory.ProductCategory_SlNo;
				this.sales.customerId = this.selectedCustomer.Customer_SlNo;
				this.sales.salesFrom = this.selectedBranch.brunch_id;

				let data = {
					sales: this.sales,
					cart: this.cart
				}

				if (this.selectedCustomer.Customer_Type == 'G' || this.selectedCustomer.Customer_Type == 'N') {
					data.customer = this.selectedCustomer;
				}
				axios.post(url, data).then(async res => {
					let r = res.data;
					if (r.success) {
						let conf = confirm('Sale success, Do you want to view invoice?');
						if (conf) {
							window.open('/sale_invoice_print/' + r.salesId, '_blank');
							await new Promise(r => setTimeout(r, 1000));
							window.location = this.sales.isService == 'false' ? '/sales/product' : '/sales/service';
						} else {
							window.location = this.sales.isService == 'false' ? '/sales/product' : '/sales/service';
						}
					} else {
						alert(r.message);
						this.saleOnProgress = false;
					}
				})
			},
			async getSales() {
				await axios.post('/get_sales', {
					salesId: this.sales.salesId
				}).then(res => {
					let r = res.data;
					let sales = r.sales[0];
					this.sales.salesBy = sales.AddBy;
					this.sales.salesFrom = sales.SaleMaster_branchid;
					this.sales.salesDate = sales.SaleMaster_SaleDate;
					this.sales.salesType = sales.SaleMaster_SaleType;
					this.sales.customerId = sales.SalseCustomer_IDNo;
					this.sales.employeeId = sales.Employee_SlNo;
					this.sales.subTotal = sales.SaleMaster_SubTotalAmount;
					this.sales.discount = sales.SaleMaster_TotalDiscountAmount;
					this.sales.vat = sales.SaleMaster_TaxAmount;
					this.sales.transportCost = sales.SaleMaster_Freight;
					this.sales.total = sales.SaleMaster_TotalSaleAmount;
					this.sales.paid = sales.SaleMaster_PaidAmount;
					this.sales.previousDue = sales.SaleMaster_Previous_Due;
					this.sales.due = sales.SaleMaster_DueAmount;
					this.sales.note = sales.SaleMaster_Description;
					this.sales.payment_type = sales.payment_type;
					this.selectedAccount = this.accounts.find(item => item.account_id == sales.account_id)

					this.oldCustomerId = sales.SalseCustomer_IDNo;
					this.oldPreviousDue = sales.SaleMaster_Previous_Due;
					this.sales_due_on_update = sales.SaleMaster_DueAmount;

					this.vatPercent = parseFloat(this.sales.vat) * 100 / parseFloat(this.sales.subTotal);
					this.discountPercent = parseFloat(this.sales.discount) * 100 / parseFloat(this.sales.subTotal);

					this.selectedEmployee = {
						Employee_SlNo: sales.employee_id,
						Employee_Name: sales.Employee_Name
					}

					this.selectedCustomer = {
						Customer_SlNo: sales.SalseCustomer_IDNo,
						Customer_Code: sales.Customer_Code,
						Customer_Name: sales.Customer_Name,
						display_name: sales.Customer_Type == 'G' ? 'General Customer' : `${sales.Customer_Code} - ${sales.Customer_Name}`,
						Customer_Mobile: sales.Customer_Mobile,
						Customer_Address: sales.Customer_Address,
						Customer_Type: sales.Customer_Type
					}

					r.saleDetails.forEach(product => {
						let cartProduct = {
							productCode: product.Product_Code,
							productId: product.Product_IDNo,
							categoryName: product.ProductCategory_Name,
							name: product.Product_Name,
							salesRate: product.SaleDetails_Rate,
							vat: product.SaleDetails_Tax,
							quantity: product.SaleDetails_TotalQuantity,
							total: product.SaleDetails_TotalAmount,
							expireDate: product.expire_date,
							purchaseRate: product.Purchase_Rate,
							quantity_text: `${Math.floor(product.SaleDetails_TotalQuantity / product.per_unit)} ${product.convert_text} ${product.SaleDetails_TotalQuantity % product.per_unit} ${product.Unit_Name}`
						}

						this.cart.push(cartProduct);
					})

					let gCustomerInd = this.customers.findIndex(c => c.Customer_Type == 'G');
					this.customers.splice(gCustomerInd, 1);
				})
			}
		},
		mounted() {
			window.addEventListener('keydown', (e) => {
				if (e.key == 'Insert') {
					this.saveSales();
				}
			});
		},
	})
</script>