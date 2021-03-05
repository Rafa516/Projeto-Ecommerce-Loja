<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="product-big-title-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-bit-title text-center">
					<h2><b>Pagamento</b></h2>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="single-product-area">
	<div class="zigzag-bottom"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-content-right">
					<form action="/checkout" class="checkout" method="post" name="checkout">
						<div id="customer_details" class="col2-set">
							<div class="row">
								<div class="col-md-12">

									<?php if( $error != '' ){ ?>

									<div class="alert alert-danger">
										<?php echo $error; ?>

									</div>
									<?php } ?>


									<div class="woocommerce-billing-fields">
										<h3 style="color: black">Endereço de entrega</h3>
										<p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
											<label class="" for="billing_cep_1">Cep <abbr title="required" class="required">*</abbr>
											</label>
											<input type="text" value="<?php echo $cart["deszipcode"]; ?>" placeholder="00000-000" id="billing_cep_1" name="zipcode" class="input-text " maxlength="8">
										
										</p>
										<div class="row">
											<div class="col-sm-9">
												<p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
													<label class="" for="billing_address_1">Endereço <abbr title="required" class="required">*</abbr>
													</label>
													<input type="text" value="<?php echo $address["desaddress"]; ?>" placeholder="Logradouro, número e bairro" id="billing_address_1" name="desaddress" class="input-text ">
												</p>
											</div>
											<div class="col-sm-3">
												<p id="billing_number_1_field" class="form-row form-row-wide number-field validate-required">
													<label class="" for="billing_number_1">Número <abbr title="required" class="required">*</abbr>
													</label>
													<input type="text" value="<?php echo $address["desnumber"]; ?>" placeholder="Número" id="billing_address_1" name="desnumber" class="input-text " >
												</p>
											</div>
										</div>
										<p id="billing_address_2_field" class="form-row form-row-wide address-field">
											<input type="text" value="<?php echo $address["descomplement"]; ?>" placeholder="Complemento (opcional)" id="billing_address_2" name="descomplement" class="input-text ">
                                        </p>
                                        <p id="billing_district_field" class="form-row form-row-wide address-field validate-required" data-o_class="form-row form-row-wide address-field validate-required">
											<label class="" for="billing_district">Bairro <abbr title="required" class="required">*</abbr>
											</label>
											<input type="text" value="<?php echo $address["desdistrict"]; ?>" placeholder="Cidade" id="billing_district" name="desdistrict" class="input-text ">
										</p>
										<p id="billing_city_field" class="form-row form-row-wide address-field validate-required" data-o_class="form-row form-row-wide address-field validate-required">
											<label class="" for="billing_city">Cidade <abbr title="required" class="required">*</abbr>
											</label>
											<input type="text" value="<?php echo $address["descity"]; ?>" placeholder="Bairro" id="billing_city" name="descity" class="input-text ">
										</p>
										<p id="billing_state_field" class="form-row form-row-first address-field validate-state" data-o_class="form-row form-row-first address-field validate-state">
											<label class="" for="billing_state">Estado</label>
											<?php if( $cart["vlfreight"] == 5 ){ ?>

											<input type="text" id="billing_state" name="desstate" placeholder="Estado" value="Distrito Federal" class="input-text" readonly>
											<?php }elseif( $cart["vlfreight"] == 8 ){ ?>

											<input type="text" id="billing_state" name="desstate" placeholder="Estado" value="Goías" class="input-text" readonly>
											<?php } ?>


										</p>
										<p id="billing_state_field" class="form-row form-row-first address-field validate-state" data-o_class="form-row form-row-first address-field validate-state">
											<label class="" for="billing_state">País</label>
											<input type="text" id="billing_state" name="descountry" placeholder="País" value="<?php echo $address["descountry"]; ?>" class="input-text ">
										</p>
										<div class="clear"></div>
										<h3 id="order_review_heading" style="margin-top:30px;color: black">Detalhes do Pedido</h3>
										<div id="order_review" style="position: relative;">
											<table class="shop_table">
												<thead>
													<tr>
														<th class="product-name">Produto</th>
														<th class="product-total">Total</th>
													</tr>
												</thead>
												<tbody>
                                                    <?php $counter1=-1;  if( isset($products) && ( is_array($products) || $products instanceof Traversable ) && sizeof($products) ) foreach( $products as $key1 => $value1 ){ $counter1++; ?>

													<tr class="cart_item">
														<td class="product-name">
															<?php echo $value1["desproduct"]; ?> <strong class="product-quantity">× <?php echo $value1["nrqtd"]; ?></strong> 
														</td>
														<td class="product-total">
															<span class="amount">R$<?php echo formatPrice($value1["vltotal"]); ?></span>
														</td>
                                                    </tr>
                                                    <?php } ?>

												</tbody>
												<tfoot>
													<tr class="cart-subtotal">
														<th>Subtotal</th>
														<td><span class="amount">R$<?php echo formatPrice($cart["vlsubtotal"]); ?></span>
														</td>
													</tr>
													<tr class="shipping">
														<th>Frete</th>
														<td>
 															<?php if( $cart["vlfreight"] == 0 ){ ?>

                                                		R$ 0,00 
                                                			<?php }else{ ?>


															R$<?php echo formatPrice($cart["vlfreight"]); ?>

															<input type="hidden" class="shipping_method" value="free_shipping" id="shipping_method_0" data-index="0" name="shipping_method[0]">
														</td>
														<?php } ?>

													</tr>
													<tr class="order-total">
														<th>Total do Pedido</th>
														<td><strong><span class="amount">R$<?php echo formatPrice($cart["vltotal"]); ?></span></strong> </td>
													</tr>
												</tfoot>
											</table>
											<p id="billing_state_field" class="form-row form-row-first address-field validate-state" data-o_class="form-row form-row-first address-field validate-state">
												<input type="radio" id="method-pagseguro" name="payment-method" placeholder="País" value="1" style="float:left; margin: 30px;">
												<label class="" for="method-pagseguro"><img style="height:64px;" src="/res/site/img/logo-pagseguro.png"></label>
											</p>
											<p id="billing_state_field" class="form-row form-row-first address-field validate-state" data-o_class="form-row form-row-first address-field validate-state">
												<input type="radio" checked="checked" id="method-paypal" name="payment-method" placeholder="País" value="2" style="float:left; margin: 30px;">
												<label class="" for="method-paypal"><img style="height:64px;" src="/res/site/img/logo-paypal.png"></label>
											</p>
											<div id="payment">
												<div class="form-row place-order">
													<input type="submit" data-value="Place order" value="Continuar" id="place_order" name="woocommerce_checkout_place_order" class="button alt">
												</div>
												<div class="clear"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>