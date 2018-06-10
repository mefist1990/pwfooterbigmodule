<div class="container-fluid">
	<div id="DIV_1">
		<div id="DIV_2">
			<div id="DIV_3">
				<div id="DIV_4">
					<div id="DIV_5">
						<div id="DIV_6">
							<div id="DIV_7">
								<div id="DIV_8">
									<div id="DIV_9">
										<h4>
                                            {l s='Categories'}
										</h4>
									</div>
								</div>
							</div>
							<div id="DIV_11">
                                {foreach from=$table_category item=category}
									<div id="DIV_12">
										<div id="DIV_13">
											<div id="DIV_14">
												<a href="{$link->getCategoryLink({$category.id_category})}">{l s={$category.name}}</a>
											</div>
										</div>
									</div>
                                {/foreach}
							</div>
						</div>
					</div>
				</div>
				<div id="DIV_36">
					<div id="DIV_37">
						<div id="DIV_38">
							<div id="DIV_39">
								<div id="DIV_40">
									<div id="DIV_41">
										<h4>
                                            {l s='Shop'}
										</h4>
									</div>
								</div>
							</div>
							<div id="DIV_43">
								<div id="DIV_44">
									<div id="DIV_45">
										<div id="DIV_46">
											<a href="{$link->getPageLink('prices-drop')}">{l s='Prices drop'}</a>
										</div>
									</div>
								</div>
								<div id="DIV_48">
									<div id="DIV_49">
										<div id="DIV_50">
											<a href="{$link->getPageLink('new-products')}">{l s='New products'}</a>
										</div>
									</div>
								</div>
								<div id="DIV_52">
									<div id="DIV_53">
										<div id="DIV_54">
											<a href="{$link->getPageLink('best-sales')}">{l s='Best sales'}</a>
										</div>
									</div>
								</div>


							</div>
						</div>
					</div>
				</div>
				<div id="DIV_64">
					<div id="DIV_65">
						<div id="DIV_66">
							<div id="DIV_67">
								<div id="DIV_68">
									<div id="DIV_69">
										<h4>
                                            {l s='Information'}
										</h4>
									</div>
								</div>
							</div>
							<div id="DIV_71">
                                {foreach from=$information_link_footer item=information}
									<div id="DIV_72">
										<div id="DIV_73">
											<div id="DIV_74">
												<a href="{$information.url}" title="{$information.title}">{$information.title}</a>
											</div>
										</div>
									</div>
                                {/foreach}

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="DIV_88">
			<div id="DIV_89">
				<div id="DIV_90">
					<div id="DIV_104">
						<div id="DIV_105">
							<div id="DIV_106">
								<h4>
                                    {l s='Stay in touch'}
								</h4>
							</div>
							<!-- noindex -->

							<ul id="UL_107">
                                {foreach from=$social_link_footer item=social_link}
								<li id="LI_108">
									<a id="A_vk" rel="nofollow" title="{$social_link.name}" href="{$social_link.url}"><span class="fa fa-{$social_link.class}"></span></a>
								</li>
                                {/foreach}
								<li id="LI_108">
									<a href="1" rel="nofollow" title="Вконтакте" id="A_vk">Вконтакте</a>
								</li>
								<li id="LI_110">
									<a href="2" rel="nofollow" title="Facebook" id="A_facebook">Facebook</a>
								</li>
								<li id="LI_112">
									<a href="3" rel="nofollow" title="Twitter" id="A_twitter">Twitter</a>
								</li>
								<li id="LI_114">
									<a href="4" rel="nofollow" title="Instagram" id="A_instagram">Instagram</a>
								</li>
								<li id="LI_116">
									<a href="5" rel="nofollow" title="YouTube" id="A_youTube">YouTube</a>
								</li>
								<li id="LI_118">
									<a href="6" rel="nofollow" title="Одноклассники" id="A_ok">Одноклассники</a>
								</li>
								<li id="LI_120">
									<a href="7" rel="nofollow" title="Google Plus" id="A_google_plus">Google Plus</a>
								</li>
								<li id="LI_122">
									<a href="8" rel="nofollow" title="Mail.ru" id="A_mail_ru">Google Plus</a>
								</li>
							</ul>
							<!-- /noindex -->

						</div>
					</div>
				</div>
				<div id="DIV_124">
					<div id="DIV_125">
						<span id="SPAN_126">Наши контакты</span>
						<!--'start_frame_cache_header-allphones-block2'-->

						<div id="DIV_127">
							<!-- noindex -->

							<div id="DIV_128">
								<i id="I_129"></i> <a rel="nofollow" href="tel:+70000000010" id="A_130">+7 (000) 000-00-10</a>
								<div id="DIV_131">
									<div id="DIV_132">
										<div id="DIV_133">
											<a rel="nofollow" href="tel:+70000000011" id="A_134">+7 (000) 000-00-11</a>
										</div>
										<div id="DIV_135">
											<a rel="nofollow" href="tel:+70000000012" id="A_136">+7 (000) 000-00-12</a>
										</div>
									</div>
								</div>
							</div>
							<!-- /noindex -->

						</div>
						<!--'end_frame_cache_header-allphones-block2'-->

						<!--'start_frame_cache_email-block1'-->

						<!--'end_frame_cache_email-block1'-->

						<!--'start_frame_cache_address-block2'-->

						<div id="DIV_137">
							Челябинск, ул. Лермонтова 21, 3 этаж, офис 4
						</div>
						<!--'end_frame_cache_address-block2'-->

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

