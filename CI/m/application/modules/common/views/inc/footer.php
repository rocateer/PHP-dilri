
		<!-- footer : s -->
    <footer>
      <ul>
        <li class="<?php if($this->uri->segment(1)==null || $this->uri->segment(1)==$this->nationcode.'/'.mapping("main")) echo "active";?>"><a href="/<?=$this->nationcode.'/'.mapping('main')?>"><span><img src="/images/bottom_tab_1.png" alt=""></span><?=lang("lang_menu_00031","홈")?></a></li>
        <li class="<?php if($this->uri->segment(1)==$this->nationcode.'/'.mapping("community")) echo "active";?>"><a href="/<?=$this->nationcode.'/'.mapping('community')?>"><span><img src="/images/bottom_tab_2.png" alt=""></span><?=lang("lang_menu_00032","커뮤니티")?></a></li>
        <li class="<?php if($this->uri->segment(1)==$this->nationcode.'/'.mapping("search")) echo "active";?>"><a href="/<?=$this->nationcode.'/'.mapping('search')?>"><span><img src="/images/bottom_tab_3.png" alt=""></span><?=lang("lang_menu_00033","검색")?></a></li>
        <li class="<?php if($this->uri->segment(1)==$this->nationcode.'/'.mapping("chatting")) echo "active";?>"><a href="/<?=$this->nationcode.'/'.mapping('chatting')?>"><span><img src="/images/bottom_tab_4.png" alt=""></span><?=lang("lang_menu_00034","채팅")?></a></li>
        <li class="<?php if($this->uri->segment(1)==$this->nationcode.'/'.mapping("mypage")) echo "active";?>"><a href="/<?=$this->nationcode.'/'.mapping('mypage')?>"><span><img src="/images/bottom_tab_5.png" alt=""></span>MY</a></li>
      </ul>
    </footer>
    <!-- footer : e -->

  </div>
  <!-- wrap : e -->
</body>
</html>
