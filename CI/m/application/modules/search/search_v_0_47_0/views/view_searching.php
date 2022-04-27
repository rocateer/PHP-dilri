<header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
	<div class="search_wrap">
		<input type="text" placeholder="검색어를 입력하세요.">
		<a href="/<?=mapping('search')?>/search_result"><img src="/images/headn_search.png" alt="search" class="btn_search"></a>
	</div>
</header>
<div class="body">
	<div class="row inner_wrap mt30">
		<span class="font_gray_9">최근 검색어</span>
		<span class="essential f_right">전체삭제</span>
	</div>

	<div class="no_datas mb30">
		<img src="/images/Icons-search-gray.png" alt="">
		<p>최근 검색 내역이 없습니다.</p>
	</div>

	<div class="recent_search_ul">
		<li>
			<a href="javascript:void(0)">
				스트라이프 에코팩
			</a>
			<img src="/images/i_delete_gray.png" alt="x" class="btn_delete">
		</li>
		<li>
			<a href="javascript:void(0)">
				에어팟
			</a>
			<img src="/images/i_delete_gray.png" alt="x" class="btn_delete">
		</li>
		<li>
			<a href="javascript:void(0)">
				스트라이프 에코팩
			</a>
			<img src="/images/i_delete_gray.png" alt="x" class="btn_delete">
		</li>
	</div>
</div>
