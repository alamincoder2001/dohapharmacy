<style>
	.v-select {
		background: #fff;
		border-radius: 10px;
		margin-top: 1px;
		margin-bottom: 5px;
	}
	#products {
		border-radius: 0;
	}

	.v-select .dropdown-toggle {
		padding: 0px;
		border-radius: 0;
	}

	.v-select.searchable .dropdown-toggle {
		border: 0;
		border-radius: 10px;
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

	@media(min-width:320px) and (max-width:440px) {
		h4.widget-title {
			font-size: 17px;
		}
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
	input[type=text],
	input[type=number],
	input[type=date],
	select,
	textarea {
		border-radius: 10px !important;
	}
</style>

<div class="row" id="purchase" style="background:#d5d2d2;padding-bottom:50px;">
	<div class="col-xs-12 col-md-5">
		<div class="widget-box" style="border: 2px solid gray;padding-right: 35px;">
			<div class="widget-main">
				<div class="widget-body">
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<div class="form-group row">
								<label class="col-xs-4 col-md-3 control-label no-padding-right"> Supplier </label>
								<div class="col-xs-7 col-md-8">
									<v-select v-bind:options="suppliers" v-model="selectedSupplier" v-on:input="onChangeSupplier" label="display_name"></v-select>
								</div>
								<div class="col-xs-1 col-md-1 no-padding-left">
									<a href="<?= base_url('supplier') ?>" class="btn btn-xs btn-danger" style="height: 24px;border: 0px;width: 27px;margin-left: -10px;margin-top: 2px;border-radius: 10px;" target="_blank" title="Add New Customer"><i class="fa fa-plus" aria-hidden="true" style="margin-top: 4px;"></i></a>
								</div>
							</div>

							<div class="form-group row" style="display:none;" v-bind:style="{display: selectedSupplier.Supplier_Type == 'G' ? '' : 'none'}">
								<label class="col-xs-4 col-md-3 control-label no-padding-right"> Name </label>
								<div class="col-xs-8 col-md-9">
									<input type="text" placeholder="Supplier Name" class="form-control" v-model="selectedSupplier.Supplier_Name" />
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xs-4 col-md-3 control-label no-padding-right"> Mobile No </label>
								<div class="col-xs-8 col-md-9">
									<input type="text" placeholder="Mobile No" class="form-control" v-model="selectedSupplier.Supplier_Mobile" v-bind:disabled="selectedSupplier.Supplier_Type == 'G' ? false : true" />
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xs-4 col-md-3 control-label no-padding-right"> Address </label>
								<div class="col-xs-8 col-md-9">
									<textarea class="form-control" v-model="selectedSupplier.Supplier_Address" v-bind:disabled="selectedSupplier.Supplier_Type == 'G' ? false : true"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-2"></div>
	<div class="col-xs-12 col-md-5">
		<div class="widget-box" style="border: 2px solid gray;">
			<div class="widget-main">
				<div class="widget-body">
					<div class="row">
					<div class="col-xs-12 col-md-12">
							<div class="form-group row">
								<label class="col-xs-4 col-md-3 control-label no-padding-right"> Last Invoice </label>
								<div class="col-xs-8 col-md-9">
									<input type="text" id="invoice" name="invoice" class="form-control" v-model="purchase.invoice" readonly />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-xs-4 col-md-3 control-label no-padding-right"> Purchase For </label>
								<div class="col-xs-8 col-md-9">
									<v-select id="branchDropdown" v-bind:options="branches" v-model="selectedBranch" label="Brunch_name" disabled></v-select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-xs-4 col-md-3 control-label no-padding-right"> Date </label>
								<div class="col-xs-8 col-md-9">
									<input class="form-control" id="purchaseDate" name="purchaseDate" class="form-control" type="date" v-model="purchase.purchaseDate" v-bind:disabled="userType == 'u' ? true : false" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-12">
		<div class="widget-box" style="border: 2px solid gray;">
			<div class="widget-main" style="padding: 5px;">
				<div class="widget-body">
					<form @submit.prevent="addToCart">
						<div class="row">
							<div class="col-xs-12 col-md-1 no-padding-right paddingMobile">
								<div class="form-group">
									<label for="item">Item No</label>
									<input type="text" id="productCode" readonly v-model="selectedProduct.Product_Code" name="productCode" class="form-control" style="border-radius:0 !important;height:27px;">
								</div>
							</div>
							<div class="col-xs-12 col-md-3 no-padding paddingMobile">
								<div class="form-group">
									<label for="">Product Name</label>
									<v-select :options="products" id="products" v-model="selectedProduct" label="display_text" @input="onChangeProduct" @search="productSearch"></v-select>
								</div>
							</div>
							<div class="col-xs-12 col-md-1 no-padding paddingMobile">
								<div class="form-group">
									<label for="genetic">Genetic</label>
									<input type="text" id="genetic" disabled v-model="selectedProduct.genetic_name" class="form-control" style="border-radius:0 !important;height:27px;">
								</div>
							</div>
							<div class="col-xs-12 col-md-2 no-padding paddingMobile">
								<div class="form-group">
									<label for="">Type</label>
									<input type="text" id="type" disabled v-model="selectedProduct.ProductCategory_Name" class="form-control" style="border-radius:0 !important;height:27px;">
								</div>
							</div>
							<!-- <div class="col-xs-12 col-md-2 no-padding paddingMobile">
								<div class="form-group">
									<label for=""> Exp. Date </label>
									<input type="date" class="form-control" v-model="selectedProduct.expire_date" required style="border-radius:0 !important;height:27px;" />
								</div>
							</div> -->
							<div class="col-xs-12 col-md-1 no-padding paddingMobile">
								<div class="form-group">
									<label for="purchaseRate">Pur. Rate</label>
									<input type="number" step="0.01" min="0" id="purchaseRate" v-model="selectedProduct.Product_Purchase_Rate" class="form-control" style="border-radius:0 !important;height:27px;" @input="productTotal">
								</div>
							</div>
							<div class="col-xs-12 col-md-1 no-padding paddingMobile">
								<div class="form-group">
									<label for="quantity">Quantity</label>
									<input type="number" min="0" id="quantity" ref="quantity" v-model="selectedProduct.qty" class="form-control" style="border-radius:0 !important;height:27px;" @input="productTotal">
								</div>
							</div>
							<div class="col-xs-12 col-md-1 no-padding paddingMobile">
								<div class="form-group">
									<label for="unitQty">Conv. Qty</label>
									<input type="number" min="0" step="0.01" id="unitQty" ref="unitQty" v-model="selectedProduct.unitQty" class="form-control" style="border-radius:0 !important;height:27px;" @input="productTotal">
								</div>
							</div>
							<div class="col-xs-12 col-md-1 no-padding paddingMobile">
								<div class="form-group">
									<label for="saleRate">Sale Rate</label>
									<input type="number" min="0" step="0.01" id="saleRate" ref="saleRate" v-model="selectedProduct.Product_SellingPrice" class="form-control" style="border-radius:0 !important;height:27px;">
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
											<td>{{ product.name }}</td>
											<td>{{ product.categoryName }}</td>
											<td>{{ product.quantity_text }}</td>
											<td>{{ product.purchaseRate }}</td>
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
									<tr>
										<td>
											<div class="form-group">
												<label class="col-xs-4 col-md-3 control-label no-padding-right">Remark</label>
												<div class="col-xs-8 col-md-9 no-padding-left">
													<textarea style="width: 100%;font-size:13px;" placeholder="Remark" v-model="purchase.note"></textarea>
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
													<input type="number" id="subTotal" class="form-control" v-model="purchase.subTotal" readonly />
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<label class="col-xs-4 col-md-3 control-label no-padding-right">Vat</label>

												<div class="col-xs-3 col-md-3 no-padding">
													<input type="number" class="form-control" id="vatPercent" name="vatPercent" v-model="vatPercent" v-on:input="calculateTotal" />
												</div>

												<label class="col-xs-1 col-md-1 control-label no-padding-left">%</label>

												<div class="col-xs-4 col-md-5 no-padding-left">
													<input type="number" class="form-control" id="vat" name="vat" v-model="purchase.vat" readonly />
												</div>

											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<label class="col-xs-4 col-md-3 control-label no-padding-right">Discount</label>

												<div class="col-xs-8 col-md-9 no-padding-left">
													<input type="number" id="discount" class="form-control" v-model="purchase.discount" v-on:input="calculateTotal" />
												</div>

											</div>
										</td>
									</tr>

									<tr>
										<td>
											<div class="form-group">
												<label class="col-xs-4 col-md-3 control-label no-padding-right">Transport</label>
												<div class="col-xs-8 col-md-9 no-padding-left">
													<input type="number" class="form-control" v-model="purchase.freight" v-on:input="calculateTotal" />
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<label class="col-xs-4 col-md-3 control-label no-padding-right">Total</label>
												<div class="col-xs-8 col-md-9 no-padding-left">
													<input type="number" id="total" class="form-control" v-model="purchase.total" readonly />
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<label class="col-xs-4 col-md-3 control-label no-padding-right">Paid</label>
												<div class="col-xs-8 col-md-9 no-padding-left">
													<input type="number" id="paid" class="form-control" v-model="purchase.paid" v-on:input="calculateTotal" v-bind:disabled="selectedSupplier.Supplier_Type == 'G' ? true : false" />
												</div>
											</div>
										</td>
									</tr>

									<tr>
										<td>
											<div class="form-group">
												<label class="col-xs-4 col-md-3 control-label no-padding-right">Due</label>
												<div class="col-xs-4 col-md-4 no-padding-left">
													<input type="number" id="due" class="form-control" v-model="purchase.due" readonly />
												</div>
												<div class="col-xs-4 col-md-5 no-padding-left">
													<input type="number" id="previousDue" class="form-control" v-model="purchase.previousDue" readonly style="color:red;" />
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group">
												<div class="col-xs-6">
													<input type="button" class="btn btn-success" value="Purchase" v-on:click="savePurchase" v-bind:disabled="purchaseOnProgress == true ? true : false" style="background:#000;color:#fff;padding:3px;width:100%;">
												</div>
												<div class="col-xs-6">
													<input type="button" class="btn btn-info" onclick="window.location = '<?php echo base_url(); ?>purchase'" value="New Purch.." style="background:#000;color:#fff;padding:3px;width:100%;">
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
		el: '#purchase',
		data() {
			return {
				purchase: {
					purchaseId: parseInt('<?php echo $purchaseId; ?>'),
					invoice: '<?php echo $invoice; ?>',
					purchaseFor: '',
					purchaseDate: moment().format('YYYY-MM-DD'),
					supplierId: '',
					subTotal: 0.00,
					vat: 0.00,
					discount: 0.00,
					freight: 0.00,
					total: 0.00,
					paid: 0.00,
					due: 0.00,
					previousDue: 0.00,
					note: ''
				},
				vatPercent: 0.00,
				branches: [],
				selectedBranch: {
					brunch_id: "<?php echo $this->session->userdata('BRANCHid'); ?>",
					Brunch_name: "<?php echo $this->session->userdata('Brunch_name'); ?>"
				},
				suppliers: [],
				selectedSupplier: {
					Supplier_SlNo: null,
					Supplier_Code: '',
					Supplier_Name: '',
					display_name: 'Select Supplier',
					Supplier_Mobile: '',
					Supplier_Address: '',
					Supplier_Type: ''
				},
				oldSupplierId: null,
				oldPreviousDue: 0,
				categories: [],
				selectedCategory: {
					ProductCategory_SlNo: 0,
					ProductCategory_Name: 'Select Category',
				},
				products2: [],
				products: [],
				selectedProduct: {
					Product_SlNo: '',
					Product_Code: '',
					display_text: 'Select Product',
					Product_Name: '',
					Unit_Name: '',
					quantity: '',
					Product_Purchase_Rate: '',
					Product_SellingPrice: 0.00,
					total: '',
					unitQty: 0,
					qty: 0,
					expired_available: 0,
					// expire_date: moment().format('YYYY-MM-DD'),
					shelf: '',
					ProductCategory_ID: 0
				},
				cart: [],
				purchaseOnProgress: false,
				userType: '<?php echo $this->session->userdata("accountType") ?>',
			}
		},
		async created() {
			await this.getSuppliers();
			this.getBranches();
			this.getProducts();

			if (this.purchase.purchaseId != 0) {
				await this.getPurchase();
			}
		},
		methods: {
			searchValue() {},
			productSearch(val) {
				this.products = this.products2.filter(product => product.Product_Name.toLowerCase().startsWith(val))
			},
			getBranches() {
				axios.get('/get_branches').then(res => {
					this.branches = res.data;
				})
			},
			async getSuppliers() {
				await axios.get('/get_suppliers').then(res => {
					this.suppliers = res.data;
					this.suppliers.unshift({
						Supplier_SlNo: 'S01',
						Supplier_Code: '',
						Supplier_Name: '',
						display_name: 'General Supplier',
						Supplier_Mobile: '',
						Supplier_Address: '',
						Supplier_Type: 'G'
					})
				})
			},
			getProducts() {
				axios.post('/get_products', {
					isService: 'false',
					categoryId: this.selectedCategory.ProductCategory_SlNo
				}).then(res => {
					this.products2 = res.data;
				})
			},
			onChangeSupplier() {
				if (this.selectedSupplier.Supplier_SlNo == null) {
					return;
				}

				if (event.type == 'readystatechange') {
					return;
				}

				if (this.purchase.purchaseId != 0 && this.oldSupplierId != parseInt(this.selectedSupplier.Supplier_SlNo)) {
					let changeConfirm = confirm('Changing supplier will set previous due to current due amount. Do you really want to change supplier?');
					if (changeConfirm == false) {
						return;
					}
				} else if (this.purchase.purchaseId != 0 && this.oldSupplierId == parseInt(this.selectedSupplier.Supplier_SlNo)) {
					this.purchase.previousDue = this.oldPreviousDue;
					return;
				}

				axios.post('/get_supplier_due', {
					supplierId: this.selectedSupplier.Supplier_SlNo
				}).then(res => {
					if (res.data.length > 0) {
						this.purchase.previousDue = res.data[0].due;
					} else {
						this.purchase.previousDue = 0;
					}
				})

				this.calculateTotal();
			},
			onChangeProduct() {
				if (this.selectedProduct.Product_SlNo == '') {
					document.querySelector("#productCode").focus();
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

				document.querySelector("#quantity").focus();

			},
			productTotal() {
				let unitQty = this.selectedProduct.unitQty ? this.selectedProduct.per_unit * this.selectedProduct.unitQty : 0;
				let pcsQty = this.selectedProduct.qty ? this.selectedProduct.qty : 0;

				this.selectedProduct.quantity = parseFloat(unitQty) + parseFloat(pcsQty);
				this.selectedProduct.total = this.selectedProduct.quantity * this.selectedProduct.Product_Purchase_Rate;
			},
			addToCart() {
				if (this.selectedProduct.Product_SlNo == '') {
					alert('Product name is empty');
					return;
				}
				// if (this.selectedProduct.expired_available == 1 && this.selectedProduct.expire_date == null) {
				// 	alert('Expire date is required');
				// 	return;
				// }
				// if (this.selectedProduct.expired_available != 1) {
				// 	this.selectedProduct.expire_date = "";
				// }
				if (this.selectedCategory == null || this.selectedCategory == '') {
					alert('Select Category');
					return;
				}

				if (this.selectedProduct.total = null || this.selectedCategory.total == '') {
					alert('Your total is empty');
					return;
				}

				if (parseFloat(this.selectedProduct.quantity) == 0 || this.selectedProduct.quantity == undefined) {
					alert("Quantity is empty");
					document.querySelector("#quantity").focus()
					return
				}

				let cartInd = this.cart.findIndex(p => p.productId == this.selectedProduct.Product_SlNo);
				if (cartInd > -1) {
					this.cart.splice(cartInd, 1);
				}
				let product = {
					productId: this.selectedProduct.Product_SlNo,
					name: this.selectedProduct.Product_Name,
					categoryId: this.selectedProduct.ProductCategory_ID,
					categoryName: this.selectedProduct.ProductCategory_Name,
					purchaseRate: this.selectedProduct.Product_Purchase_Rate,
					salesRate: this.selectedProduct.Product_SellingPrice,
					quantity: this.selectedProduct.quantity,
					// total: this.selectedProduct.total,
					total: this.selectedProduct.quantity * this.selectedProduct.Product_Purchase_Rate,
					// expireDate: this.selectedProduct.expire_date,
					quantity_text: `${Math.floor(this.selectedProduct.quantity / this.selectedProduct.per_unit)} ${this.selectedProduct.convert_text} ${this.selectedProduct.quantity % this.selectedProduct.per_unit} ${this.selectedProduct.Unit_Name}`
				}

				this.cart.push(product);
				this.clearSelectedProduct();
				this.calculateTotal();
				document.querySelector("#products [type='search']").focus();
			},
			async removeFromCart(ind) {
				if (this.cart[ind].id) {
					let stock = await axios.post('/get_product_stock', {
						productId: this.cart[ind].productId
					}).then(res => res.data);
					if (this.cart[ind].quantity > stock) {
						alert('Stock unavailable');
						return;
					}
				}
				this.cart.splice(ind, 1);
				this.calculateTotal();
			},
			clearSelectedProduct() {
				this.selectedProduct = {
					Product_SlNo: '',
					Product_Code: '',
					display_text: 'Select Product',
					Product_Name: '',
					Unit_Name: '',
					quantity: '',
					Product_Purchase_Rate: '',
					Product_SellingPrice: 0.00,
					total: '',
					unitQty: 0,
					qty: 0,
					// expire_date: moment().format('YYYY-MM-DD'),
					ProductCategory_ID: '',
					shelf: ''
				};
			},
			calculateTotal() {
				this.purchase.subTotal = this.cart.reduce((prev, curr) => {
					return prev + parseFloat(curr.total);
				}, 0).toFixed(2);
				this.purchase.vat = ((this.purchase.subTotal * parseFloat(this.vatPercent)) / 100).toFixed(2);
				this.purchase.total = ((parseFloat(this.purchase.subTotal) + parseFloat(this.purchase.vat) + parseFloat(this.purchase.freight)) - parseFloat(this.purchase.discount)).toFixed(2);
				if (this.selectedSupplier.Supplier_Type == 'G') {
					this.purchase.paid = this.purchase.total;
					this.purchase.due = 0;
				} else {
					if (event.target.id != 'paid') {
						this.purchase.paid = 0;
					}

					this.purchase.due = (parseFloat(this.purchase.total) - parseFloat(this.purchase.paid)).toFixed(2);
				}
			},
			savePurchase() {
				if (this.selectedSupplier.Supplier_SlNo == null) {
					alert('Select supplier');
					return;
				}

				if (this.purchase.purchaseDate == '') {
					alert('Enter purchase date');
					return;
				}

				if (this.cart.length == 0) {
					alert('Cart is empty');
					return;
				}
				this.purchase.ProductCategory_ID = this.selectedCategory.ProductCategory_SlNo;
				this.purchase.supplierId = this.selectedSupplier.Supplier_SlNo;
				this.purchase.purchaseFor = this.selectedBranch.brunch_id;

				this.purchaseOnProgress = true;

				let data = {
					purchase: this.purchase,
					cartProducts: this.cart
				}

				if (this.selectedSupplier.Supplier_Type == 'G') {
					data.supplier = this.selectedSupplier;
				}

				let url = '/add_purchase';
				if (this.purchase.purchaseId != 0) {
					url = '/update_purchase';
				}

				axios.post(url, data).then(async res => {
					let r = res.data;
					alert(r.message);
					if (r.success) {
						let conf = confirm('Do you want to view invoice?');
						if (conf) {
							window.open(`/purchase_invoice_print/${r.purchaseId}`, '_blank');
							await new Promise(r => setTimeout(r, 1000));
							window.location = '/purchase';
						} else {
							window.location = '/purchase';
						}
					} else {
						this.purchaseOnProgress = false;
					}
				})
			},
			async getPurchase() {
				await axios.post('/get_purchases', {
					purchaseId: this.purchase.purchaseId
				}).then(res => {
					let r = res.data;
					let purchase = r.purchases[0];

					this.selectedSupplier.Supplier_SlNo = purchase.Supplier_SlNo;
					this.selectedSupplier.Supplier_Code = purchase.Supplier_Code;
					this.selectedSupplier.Supplier_Name = purchase.Supplier_Name;
					this.selectedSupplier.Supplier_Mobile = purchase.Supplier_Mobile;
					this.selectedSupplier.Supplier_Address = purchase.Supplier_Address;
					this.selectedSupplier.Supplier_Type = purchase.Supplier_Type;
					this.selectedSupplier.display_name = purchase.Supplier_Type == 'G' ? 'General Supplier' : `${purchase.Supplier_Code} - ${purchase.Supplier_Name}`;

					this.purchase.invoice = purchase.PurchaseMaster_InvoiceNo;
					this.purchase.purchaseFor = purchase.PurchaseMaster_PurchaseFor;
					this.purchase.purchaseDate = purchase.PurchaseMaster_OrderDate;
					this.purchase.supplierId = purchase.Supplier_SlNo;
					this.purchase.subTotal = purchase.PurchaseMaster_SubTotalAmount;
					this.purchase.vat = purchase.PurchaseMaster_Tax;
					this.purchase.discount = purchase.PurchaseMaster_DiscountAmount;
					this.purchase.freight = purchase.PurchaseMaster_Freight;
					this.purchase.total = purchase.PurchaseMaster_TotalAmount;
					this.purchase.paid = purchase.PurchaseMaster_PaidAmount;
					this.purchase.due = purchase.PurchaseMaster_DueAmount;
					this.purchase.previousDue = purchase.previous_due;
					this.purchase.note = purchase.PurchaseMaster_Description;

					this.oldSupplierId = purchase.Supplier_SlNo;
					this.oldPreviousDue = purchase.previous_due;

					this.vatPercent = (this.purchase.vat * 100) / this.purchase.subTotal;

					r.purchaseDetails.forEach(product => {
						let cartProduct = {
							id: product.PurchaseDetails_SlNo,
							productId: product.Product_IDNo,
							name: product.Product_Name,
							categoryId: product.ProductCategory_ID,
							categoryName: product.ProductCategory_Name,
							purchaseRate: product.PurchaseDetails_Rate,
							salesRate: product.Product_SellingPrice,
							quantity: product.PurchaseDetails_TotalQuantity,
							total: product.PurchaseDetails_TotalAmount,
							quantity_text: `${Math.floor(product.PurchaseDetails_TotalQuantity / product.per_unit)} ${product.convert_text} ${product.PurchaseDetails_TotalQuantity % product.per_unit} ${product.Unit_Name}`,
							// expireDate: product.expire_date
						}

						this.cart.push(cartProduct);
					})

					let gSupplierInd = this.suppliers.findIndex(s => s.Supplier_Type == 'G');
					this.suppliers.splice(gSupplierInd, 1);
				})
			}
		},
		mounted() {
			window.addEventListener('keydown', (e) => {
				if (e.key == 'Insert') {
					this.savePurchase();
				}
			});
		},
	})
</script>