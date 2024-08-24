			<div class="sidebar" id="sidebar">
				<div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">

						<ul class="sidebar-vertical">

							<li>
								<a href="{{ url('dashboard') }}"><i class="la la-dashboard"></i> <span> Dashboard</span></a>

							</li>



							@if (Sentinel::hasAccess('branches'))
							<li class="submenu @if (Request::is('branch/*')) active @endif">
								<a href="#"><i class="la la-building"></i> <span> {{ trans_choice('general.branch', 2) }}</span> <span class="menu-arrow"></span></a>
								<ul>
									@if (Sentinel::hasAccess('branches.view'))
									<li><a href="{{ url('branch/data') }}">{{ trans_choice('general.view', 1) }} {{ trans_choice('general.branch', 2) }}</a></li>
									@endif
									@if (Sentinel::hasAccess('branches.create'))
									<li><a href="{{ url('branch/create') }}">{{ trans_choice('general.add', 1) }} {{ trans_choice('general.branch', 1) }}</a></li>
									@endif

								</ul>
							</li>
							@endif

							@if (Sentinel::hasAccess('members'))
							<li class="submenu @if (Request::is('member/*')) active @endif">
								<a href="#"><i class="la la-users"></i> <span> {{ trans_choice('general.member', 2) }}</span> <span class="menu-arrow"></span></a>
								<ul>
									@if (Sentinel::hasAccess('members.view'))
									<li><a href="{{ url('member/data') }}">{{ trans_choice('general.view', 1) }} {{ trans_choice('general.member', 2) }}</a></li>
									@endif
									@if (Sentinel::hasAccess('members.create'))
									<li><a href="{{ url('member/data') }}">{{ trans_choice('general.add', 1) }} {{ trans_choice('general.member', 1) }}</a></li>
									@endif

								</ul>
							</li>
							@endif

							@if (Sentinel::hasAccess('members'))
							<li class="submenu @if (Request::is('soul_winning/*')) active @endif">
								<a href="#"><i class="la la-handshake"></i> <span> {{ trans_choice('general.soul_winning', 2) }}</span> <span class="menu-arrow"></span></a>
								<ul>
									@if (Sentinel::hasAccess('members.view'))
									<li><a href="{{ url('soul_winning/data') }}">{{ trans_choice('general.view', 1) }} {{ trans_choice('general.soul_winning', 2) }}</a></li>
									@endif
									@if (Sentinel::hasAccess('members.create'))
									<li><a href="{{ url('soul_winning/create') }}">{{ trans_choice('general.add', 1) }} {{ trans_choice('general.soul_winning', 1) }}</a></li>
									@endif

								</ul>
							</li>
							@endif


							@if (Sentinel::hasAccess('events'))
						

							<li class="submenu @if (Request::is('event/*')) active @endif">
								<a href="#"><i class="la la-calendar"></i> <span> {{ trans_choice('general.event', 2) }}</span> <span class="menu-arrow"></span></a>
								<ul>
									@if (Sentinel::hasAccess('events.view'))

									<li><a href="{{ url('event/data') }}">{{ trans_choice('general.view', 1) }} {{ trans_choice('general.event', 2) }}</a></li>
									@endif
									<!-- @if (Sentinel::hasAccess('events.create'))

									<li><a href="{{ url('event/create') }}">{{ trans_choice('general.add', 1) }} {{ trans_choice('general.event', 1) }}</a></li>
									@endif -->

								</ul>
							</li>
							@endif
							@if (Sentinel::hasAccess('pledges'))


							<li class="submenu @if (Request::is('pledge/*')) active @endif">
								<a href="#"><i class="la la-gift"></i> <span> {{ trans_choice('general.pledge', 2) }}</span> <span class="menu-arrow"></span></a>
								<ul>
									@if (Sentinel::hasAccess('pledges.view'))
									<li><a href="{{ url('pledge/data') }}">{{ trans_choice('general.view', 1) }} {{ trans_choice('general.pledge', 2) }}</a></li>
									@endif
									@if (Sentinel::hasAccess('pledges.create'))
									<li><a href="{{ url('pledge/create') }}">{{ trans_choice('general.add', 1) }} {{ trans_choice('general.pledge', 1) }}</a></li>
									@endif

									@if (Sentinel::hasAccess('pledges.view'))
									<li><a href="{{ url('pledge/campaign/data') }}">{{ trans_choice('general.view', 1) }} {{ trans_choice('general.campaign', 2) }}</a></li>
									@endif
									@if (Sentinel::hasAccess('pledges.create'))
									<li><a href="{{ url('pledge/campaign/create') }}">{{ trans_choice('general.add', 1) }} {{ trans_choice('general.campaign', 1) }}</a></li>
									@endif

								</ul>
							</li>
							@endif
							@if (Sentinel::hasAccess('contributions'))


							<li class="submenu @if (Request::is('contribution/*')) active @endif">
								<a href="#"><i class="la la-donate"></i> <span> {{ trans_choice('general.contribution', 2) }}</span> <span class="menu-arrow"></span></a>
								<ul>
									@if (Sentinel::hasAccess('contributions.view'))
									<li><a href="{{ url('contribution/data') }}">{{ trans_choice('general.view', 1) }} {{ trans_choice('general.contribution', 2) }}</a></li>
									@endif
									@if (Sentinel::hasAccess('contributions.create'))
									<li><a href="{{ url('contribution/create') }}">{{ trans_choice('general.add', 1) }} {{ trans_choice('general.contribution', 1) }}</a></li>
									@endif

									@if (Sentinel::hasAccess('contributions.view'))
									<li><a href="{{ url('contribution/payment_method/data') }}">{{ trans_choice('general.view', 1) }} {{ 'Payment Method' }}</a></li>
									@endif
									@if (Sentinel::hasAccess('contributions.create'))
									<li><a href="{{ url('contribution/payment_method/create') }}">{{ trans_choice('general.add', 1) }} {{ 'Payment Method' }}</a></li>
									@endif

									@if (Sentinel::hasAccess('contributions.view'))
									<li><a href="{{ url('contribution/fund/data') }}">{{ trans_choice('general.view', 1) }} {{ trans_choice('general.fund', 2) }}</a></li>
									@endif
									@if (Sentinel::hasAccess('contributions.create'))
									<li><a href="{{ url('contribution/fund/create') }}">{{ trans_choice('general.add', 1) }} {{ trans_choice('general.fund', 1) }}</a></li>
									@endif

									@if (Sentinel::hasAccess('contributions.view'))
									<li><a href="{{ url('contribution/batch/data') }}">{{ trans_choice('general.view', 1) }} {{ trans_choice('general.batch', 2) }}</a></li>
									@endif
									@if (Sentinel::hasAccess('contributions.create'))
									<li><a href="{{ url('contribution/batch/create') }}">{{ trans_choice('general.add', 1) }} {{ trans_choice('general.batch', 1) }}</a></li>
									@endif

								</ul>
							</li>
							@endif
							@if (Sentinel::hasAccess('follow_ups'))

							<li class="submenu @if (Request::is('follow_up/*')) active @endif">
								<a href="#"><i class="la la-comments"></i> <span> {{ trans_choice('general.follow_up', 2) }}</span> <span class="menu-arrow"></span></a>
								<ul>

									@if (Sentinel::hasAccess('follow_ups.view'))
									<li><a href="{{ url('follow_up/data') }}"></i>
											{{ trans_choice('general.view', 1) }} {{ trans_choice('general.follow_up', 2) }}
										</a></li>
									@endif
									@if (Sentinel::hasAccess('follow_ups.view'))
									<li><a href="{{ url('follow_up/data?assigned_to_id=' . Sentinel::getUser()->id) }}"></i> {{ trans_choice('general.my', 1) }}
											{{ trans_choice('general.follow_up', 2) }}
										</a></li>
									@endif
									@if (Sentinel::hasAccess('follow_ups.create'))
									<li><a href="{{ url('follow_up/create') }}"></i>
											{{ trans_choice('general.add', 1) }} {{ trans_choice('general.follow_up', 1) }}
										</a></li>
									@endif
									@if (Sentinel::hasAccess('follow_ups.create'))
									<li><a href="{{ url('follow_up/category/data') }}"></i>
											{{ trans_choice('general.manage', 1) }} {{ trans_choice('general.follow_up', 1) }}
											{{ trans_choice('general.category', 2) }}
										</a></li>
									@endif
								</ul>
							</li>
							@endif
							@if (Sentinel::hasAccess('payroll'))


							<li class="submenu @if (Request::is('payroll/*')) active @endif">
								<a href="#"><i class="la la-paypal"></i> <span> {{ trans_choice('general.payroll', 2) }}</span> <span class="menu-arrow"></span></a>
								<ul>
									@if (Sentinel::hasAccess('payroll.view'))
									<li><a href="{{ url('payroll/data') }}"><i class="fa fa-circle-o"></i>
											{{ trans_choice('general.view', 2) }} {{ trans_choice('general.payroll', 1) }}
										</a></li>
									@endif
									@if (Sentinel::hasAccess('payroll.create'))
									<li><a href="{{ url('payroll/create') }}"><i class="fa fa-circle-o"></i>
											{{ trans_choice('general.add', 1) }} {{ trans_choice('general.payroll', 1) }}
										</a></li>
									@endif
									@if (Sentinel::hasAccess('payroll.update'))
									<li><a href="{{ url('payroll/template') }}"><i class="fa fa-circle-o"></i>
											{{ trans_choice('general.manage', 1) }} {{ trans_choice('general.payroll', 1) }}
											{{ trans_choice('general.template', 2) }}
										</a></li>
									@endif
								</ul>
							</li>
							@endif
							@if (Sentinel::hasAccess('expenses'))


							<li class="submenu @if (Request::is('expense/*')) active @endif">
								<a href="#"><i class="la la-share"></i> <span> {{ trans_choice('general.expense', 2) }}</span> <span class="menu-arrow"></span></a>
								<ul>
									@if (Sentinel::hasAccess('expenses.view'))
									<li><a href="{{ url('expense/data') }}"><i class="fa fa-circle-o"></i>
											{{ trans_choice('general.view', 1) }} {{ trans_choice('general.expense', 2) }}
										</a></li>
									@endif
									@if (Sentinel::hasAccess('expenses.create'))
									<li><a href="{{ url('expense/create') }}"><i class="fa fa-circle-o"></i>
											{{ trans_choice('general.add', 2) }} {{ trans_choice('general.expense', 1) }}
										</a></li>
									@endif
									@if (Sentinel::hasAccess('expenses.create'))
									<li><a href="{{ url('expense/type/data') }}"><i class="fa fa-circle-o"></i>
											{{ trans_choice('general.manage', 2) }} {{ trans_choice('general.expense', 1) }}
											{{ trans_choice('general.type', 2) }}
										</a></li>
									@endif
								</ul>
							</li>
							@endif
							@if (Sentinel::hasAccess('other_income'))


							<li class="submenu @if (Request::is('other_income/*')) active @endif">
								<a href="#"><i class="la la-plus"></i> <span> {{ trans_choice('general.other_income', 2) }}</span> <span class="menu-arrow"></span></a>
								<ul>
									@if (Sentinel::hasAccess('other_income.view'))
									<li><a href="{{ url('other_income/data') }}"><i class="fa fa-circle-o"></i>
											{{ trans_choice('general.view', 2) }}
											{{ trans_choice('general.other_income', 1) }}
										</a></li>
									@endif
									@if (Sentinel::hasAccess('other_income.create'))
									<li><a href="{{ url('other_income/create') }}"><i class="fa fa-circle-o"></i>
											{{ trans_choice('general.add', 2) }}
											{{ trans_choice('general.other_income', 1) }}
										</a></li>
									@endif
									@if (Sentinel::hasAccess('other_income.create'))
									<li><a href="{{ url('other_income/type/data') }}"><i class="fa fa-circle-o"></i>
											{{ trans_choice('general.manage', 2) }}
											{{ trans_choice('general.other_income', 1) }}
											{{ trans_choice('general.type', 2) }}
										</a></li>
									@endif
								</ul>
							</li>


							@endif
							@if (Sentinel::hasAccess('reports'))


							<li class="submenu @if (Request::is('report/*')) active @endif">
								<a href="#"><i class="la la-pie-chart"></i> <span> {{ trans_choice('general.report', 2) }}</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a href="{{ url('report/cash_flow') }}"><i class="fa fa-circle-o"></i>
											{{ trans_choice('general.cash_flow', 2) }}
										</a></li>
									<li><a href="{{ url('report/profit_loss') }}"><i class="fa fa-circle-o"></i>
											{{ trans_choice('general.profit_loss', 2) }}
										</a></li>

								</ul>
							</li>
							@endif
							@if (Sentinel::hasAccess('communication'))


							<li class="submenu @if (Request::is('asset/*')) active @endif">
								<a href="#"><i class="la la-briefcase"></i> <span> {{ trans_choice('general.asset', 2) }}</span> <span class="menu-arrow"></span></a>
								<!-- <ul>
			                        @if (Sentinel::hasAccess('other_income.view'))
			                        <li><a href="{{ url('other_income/data') }}"><i class="fa fa-circle-o"></i>
			                                {{ trans_choice('general.view', 2) }}
			                                {{ trans_choice('general.other_income', 1) }}
			                            </a></li>
			                        @endif
			                        @if (Sentinel::hasAccess('other_income.create'))
			                        <li><a href="{{ url('other_income/create') }}"><i class="fa fa-circle-o"></i>
			                                {{ trans_choice('general.add', 2) }}
			                                {{ trans_choice('general.other_income', 1) }}
			                            </a></li>
			                        @endif
			                        @if (Sentinel::hasAccess('other_income.create'))
			                        <li><a href="{{ url('other_income/type/data') }}"><i class="fa fa-circle-o"></i>
			                                {{ trans_choice('general.manage', 2) }}
			                                {{ trans_choice('general.other_income', 1) }}
			                                {{ trans_choice('general.type', 2) }}
			                            </a></li>
			                        @endif
			                    </ul> -->

								<ul>
									<li><a href="{{ url('asset/data') }}"><i class="fa fa-circle-o"></i>
											{{ trans_choice('general.view', 1) }} {{ trans_choice('general.asset', 2) }}
										</a></li>
									<li><a href="{{ url('asset/create') }}"><i class="fa fa-circle-o"></i>
											{{ trans_choice('general.add', 1) }} {{ trans_choice('general.asset', 1) }}
										</a></li>
									<li><a href="{{ url('asset/type/data') }}"><i class="fa fa-circle-o"></i>
											{{ trans_choice('general.manage', 1) }} {{ trans_choice('general.asset', 1) }}
											{{ trans_choice('general.type', 2) }}
										</a></li>
								</ul>
							</li>
							@endif
							@if (Sentinel::hasAccess('communication'))


							<li class="submenu @if (Request::is('communication/*')) active @endif">
								<a href="#"><i class="la la-microphone"></i> <span> {{ trans_choice('general.communication', 2) }}</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a href="{{ url('communication/email') }}">
											{{ trans_choice('general.email', 1) }}
										</a></li>
									<li><a href="{{ url('communication/sms') }}">
											{{ trans_choice('general.sms', 2) }}
										</a></li>
									<li><a href="{{ url('sms_gateway/data') }}">
											{{ trans_choice('general.sms', 1) }} {{ trans_choice('general.gateway', 2) }}
										</a></li>
								</ul>
							</li>
							@endif
							@if (Sentinel::hasAccess('custom_fields'))


							<li class="submenu @if (Request::is('custom_field/*')) active @endif">
								<a href="#"><i class="la la-puzzle-piece"></i> <span> {{ trans_choice('general.custom_field', 2) }}</span> <span class="menu-arrow"></span></a>


								<ul>
									@if (Sentinel::hasAccess('custom_fields.view'))
									<li><a href="{{ url('custom_field/data') }}">
											{{ trans_choice('general.view', 2) }}
											{{ trans_choice('general.custom_field', 2) }}
										</a></li>
									@endif
									@if (Sentinel::hasAccess('custom_fields.create'))
									<li><a href="{{ url('custom_field/create') }}">
											{{ trans_choice('general.add', 2) }}
											{{ trans_choice('general.custom_field', 1) }}
										</a></li>
									@endif
								</ul>
							</li>
							@endif
							@if (Sentinel::hasAccess('users'))


							<li class="submenu @if (Request::is('user/*')) active @endif">
								<a href="#"><i class="la la-user-plus"></i> <span> {{ trans_choice('general.user', 2) }}</span> <span class="menu-arrow"></span></a>
								<ul>
									@if (Sentinel::hasAccess('users.view'))
									<li><a href="{{ url('user/data') }}">

											<span>{{ trans_choice('general.view', 2) }}
												{{ trans_choice('general.user', 2) }}</span>
										</a></li>
									@endif
									@if (Sentinel::hasAccess('users.roles'))
									<li><a href="{{ url('user/role/data') }}">{{ trans_choice('general.manage', 2) }}
											{{ trans_choice('general.role', 2) }}
										</a></li>
									@endif
									@if (Sentinel::hasAccess('users.create'))
									<li><a href="{{ url('user/create') }}">{{ trans_choice('general.add', 2) }}
											{{ trans_choice('general.user', 2) }}
										</a></li>
									@endif
								</ul>
							</li>
							@endif
							@if (Sentinel::hasAccess('audit_trail'))
							<!-- <li class="@if (Request::is('audit_trail/*')) active @endif">
			                    <a href="{{ url('audit_trail/data') }}">
			                        <i class="fa fa-area-chart"></i> <span>{{ trans_choice('general.audit_trail', 2) }}</span>
			                    </a>
			                </li> -->

							<li class="@if (Request::is('audit_trail/*')) active @endif">
								<a href="{{ url('audit_trail/data') }}">
									<i class="la la-area-chart"></i> <span> {{ trans_choice('general.audit_trail', 2) }}</span>
								</a>
							</li>
							@endif
							@if (Sentinel::hasAccess('settings'))


							<li class="@if (Request::is('setting/*')) active @endif">
								<a href="{{ url('setting/data') }}">
									<i class="la la-cog"></i> <span> {{ trans_choice('general.setting', 2) }}</span> <span class="menu-arrow"></span>
								</a>

							</li>
							@endif



						</ul>

					</div>
				</div>
			</div>