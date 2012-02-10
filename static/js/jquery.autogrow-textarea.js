
    

  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
        <title>javascripts/jquery.autogrow-textarea.js at master from jaz303's jquery-grab-bag - GitHub</title>
    <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="GitHub" />
    <link rel="fluid-icon" href="https://github.com/fluidicon.png" title="GitHub" />

    <link href="https://assets3.github.com/stylesheets/bundle_common.css?a1df53439d4f181c6154c3d5f1c3056b24eb59c5" media="screen" rel="stylesheet" type="text/css" />
<link href="https://assets3.github.com/stylesheets/bundle_github.css?a1df53439d4f181c6154c3d5f1c3056b24eb59c5" media="screen" rel="stylesheet" type="text/css" />

    <script type="text/javascript">
      if (typeof console == "undefined" || typeof console.log == "undefined")
        console = { log: function() {} }
    </script>
    <script type="text/javascript" charset="utf-8">
      var GitHub = {}
      var github_user = null
      
    </script>
    <script src="https://assets1.github.com/javascripts/jquery/jquery-1.4.2.min.js?a1df53439d4f181c6154c3d5f1c3056b24eb59c5" type="text/javascript"></script>
    <script src="https://assets1.github.com/javascripts/bundle_common.js?a1df53439d4f181c6154c3d5f1c3056b24eb59c5" type="text/javascript"></script>
<script src="https://assets2.github.com/javascripts/bundle_github.js?a1df53439d4f181c6154c3d5f1c3056b24eb59c5" type="text/javascript"></script>


        <script type="text/javascript" charset="utf-8">
      GitHub.spy({
        repo: "jaz303/jquery-grab-bag"
      })
    </script>

    
  
    
  

  <link href="https://github.com/jaz303/jquery-grab-bag/commits/master.atom" rel="alternate" title="Recent Commits to jquery-grab-bag:master" type="application/atom+xml" />

        <meta name="description" content="Miscellaneous small jQuery plugins" />
    <script type="text/javascript">
      GitHub.nameWithOwner = GitHub.nameWithOwner || "jaz303/jquery-grab-bag";
      GitHub.currentRef = 'master';
      GitHub.commitSHA = "307fbfedfb69f594a94048c554c11249bedcd77b";
      GitHub.currentPath = 'javascripts/jquery.autogrow-textarea.js';
      GitHub.masterBranch = "master";

      
    </script>
  

            <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-3769691-2']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script');
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        ga.setAttribute('async', 'true');
        document.documentElement.firstChild.appendChild(ga);
      })();
    </script>

          <script type="text/javascript">
      var mpq = [];
      mpq.push(["init", "65fde2abd433eae3b32b38b7ebd2f37e"]);
      (function() {
      var mp = document.createElement("script"); mp.type = "text/javascript"; mp.async = true;
      mp.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + "//api.mixpanel.com/site_media/js/api/mixpanel.js";
      var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(mp, s);
      })();
      </script>

  </head>

  

  <body class="logged_out page-blob">
    

    

    

    
      <div id="site_alert">
        <form action="/translate?to=%2Fjaz303%2Fjquery-grab-bag%2Fblob%2Fmaster%2Fjavascripts%2Fjquery.autogrow-textarea.js" method="post"><div style="margin:0;padding:0"><input name="authenticity_token" type="hidden" value="cef9227961bb8e0c8903fb11bfd38daf0c96e9e9" /></div>        <p>
          Would you rather see this site in Spanish? (¿Deseas ver este sitio en Español?) &nbsp;
          <button class="minibutton" name="code" value="es"><span>Yes (Sí)</span></button> &nbsp;
          <button class="minibutton" name="code" value="en"><span>No (No)</span></button>
        </p>
        </form>      </div>
    

    

    <div class="subnavd" id="main">
      <div id="header" class="true">
        
          <a class="logo boring" href="https://github.com">
            <img src="/images/modules/header/logov3.png?changed" class="default" alt="github" />
            <![if !IE]>
            <img src="/images/modules/header/logov3-hover.png" class="hover" alt="github" />
            <![endif]>
          </a>
        
        
        <div class="topsearch">
  
    <ul class="nav logged_out">
      <li class="pricing"><a href="/plans">Pricing and Signup</a></li>
      <li class="explore"><a href="/explore">Explore GitHub</a></li>
      <li class="features"><a href="/features">Features</a></li>
      <li class="blog"><a href="/blog">Blog</a></li>
      <li class="login"><a href="/login?return_to=https://github.com/jaz303/jquery-grab-bag/blob/master/javascripts/jquery.autogrow-textarea.js">Login</a></li>
    </ul>
  
</div>

      </div>

      
      
        
    <div class="site">
      <div class="pagehead repohead vis-public   ">

      
      <div id="entice">
        <div class="explanation">
          <h2><strong>jaz303</strong> is using GitHub to share code with you!</h2>
        <p>
          GitHub is more than just a place to share code. It's a place to keep tabs on your favorite developers and projects, easily contribute fixes and new features, and visualize what's going on inside your codebase!
        </p>
        </div>
        <div class="signup">
          <a href="/signup/free?green&amp;referral_code=entice-banner" id="entice-signup-button">Sign Up Now</a>
          <p id="oss-caption">Free for open source</p>
        </div>
      </div>
      
    

      <div class="title-actions-bar">
        <h1>
          <a href="/jaz303">jaz303</a> / <strong><a href="https://github.com/jaz303/jquery-grab-bag">jquery-grab-bag</a></strong>
          
          
        </h1>

        
    <ul class="actions">
      

      
        <li class="for-owner" style="display:none"><a href="https://github.com/jaz303/jquery-grab-bag/admin" class="minibutton btn-admin "><span><span class="icon"></span>Admin</span></a></li>
        <li>
          <a href="/jaz303/jquery-grab-bag/toggle_watch" class="minibutton btn-watch " id="watch_button" onclick="var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'POST'; f.action = this.href;var s = document.createElement('input'); s.setAttribute('type', 'hidden'); s.setAttribute('name', 'authenticity_token'); s.setAttribute('value', 'cef9227961bb8e0c8903fb11bfd38daf0c96e9e9'); f.appendChild(s);f.submit();return false;" style="display:none"><span><span class="icon"></span>Watch</span></a>
          <a href="/jaz303/jquery-grab-bag/toggle_watch" class="minibutton btn-watch " id="unwatch_button" onclick="var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'POST'; f.action = this.href;var s = document.createElement('input'); s.setAttribute('type', 'hidden'); s.setAttribute('name', 'authenticity_token'); s.setAttribute('value', 'cef9227961bb8e0c8903fb11bfd38daf0c96e9e9'); f.appendChild(s);f.submit();return false;" style="display:none"><span><span class="icon"></span>Unwatch</span></a>
        </li>
        
          
            <li class="for-notforked" style="display:none"><a href="/jaz303/jquery-grab-bag/fork" class="minibutton btn-fork " id="fork_button" onclick="var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'POST'; f.action = this.href;var s = document.createElement('input'); s.setAttribute('type', 'hidden'); s.setAttribute('name', 'authenticity_token'); s.setAttribute('value', 'cef9227961bb8e0c8903fb11bfd38daf0c96e9e9'); f.appendChild(s);f.submit();return false;"><span><span class="icon"></span>Fork</span></a></li>
            <li class="for-hasfork" style="display:none"><a href="#" class="minibutton btn-fork " id="your_fork_button"><span><span class="icon"></span>Your Fork</span></a></li>
          

          
        
      
      
      <li class="repostats">
        <ul class="repo-stats">
          <li class="watchers"><a href="/jaz303/jquery-grab-bag/watchers" title="Watchers" class="tooltipped downwards">66</a></li>
          <li class="forks"><a href="/jaz303/jquery-grab-bag/network" title="Forks" class="tooltipped downwards">7</a></li>
        </ul>
      </li>
    </ul>

      </div>

        
  <ul class="tabs">
    <li><a href="https://github.com/jaz303/jquery-grab-bag" class="selected" highlight="repo_source">Source</a></li>
    <li><a href="https://github.com/jaz303/jquery-grab-bag/commits/master" highlight="repo_commits">Commits</a></li>
    <li><a href="/jaz303/jquery-grab-bag/network" highlight="repo_network">Network</a></li>
    <li><a href="/jaz303/jquery-grab-bag/pulls" highlight="repo_pulls">Pull Requests (0)</a></li>

    

    
      
      <li><a href="/jaz303/jquery-grab-bag/issues" highlight="issues">Issues (0)</a></li>
    

            
    <li><a href="/jaz303/jquery-grab-bag/graphs" highlight="repo_graphs">Graphs</a></li>

    <li class="contextswitch nochoices">
      <span class="toggle leftwards" >
        <em>Branch:</em>
        <code>master</code>
      </span>
    </li>
  </ul>

  <div style="display:none" id="pl-description"><p><em class="placeholder">click here to add a description</em></p></div>
  <div style="display:none" id="pl-homepage"><p><em class="placeholder">click here to add a homepage</em></p></div>

  <div class="subnav-bar">
  
  <ul>
    <li>
      <a href="#" class="dropdown">Switch Branches (1)</a>
      <ul>
        
          
            <li><strong>master &#x2713;</strong></li>
            
      </ul>
    </li>
    <li>
      <a href="#" class="dropdown defunct">Switch Tags (0)</a>
      
    </li>
    <li>
    
    <a href="/jaz303/jquery-grab-bag/branches" class="manage">Branch List</a>
    
    </li>
  </ul>
</div>

  
  
  
  
  
  



        
    <div class="frame frame-center tree-finder" style="display: none">
      <div class="breadcrumb">
        <b><a href="/jaz303/jquery-grab-bag">jquery-grab-bag</a></b> /
        <input class="tree-finder-input" type="text" name="query" autocomplete="off" spellcheck="false">
      </div>

      
        <div class="octotip">
          <p>
            <a href="/jaz303/jquery-grab-bag/dismiss-tree-finder-help" class="dismiss js-dismiss-tree-list-help" title="Hide this notice forever">Dismiss</a>
            <strong>Octotip:</strong> You've activated the <em>file finder</em> by pressing <span class="kbd">t</span>
            Start typing to filter the file list. Use <span class="kbd badmono">↑</span> and <span class="kbd badmono">↓</span> to navigate,
            <span class="kbd">enter</span> to view files.
          </p>
        </div>
      

      <table class="tree-browser" cellpadding="0" cellspacing="0">
        <tr class="js-header"><th>&nbsp;</th><th>name</th></tr>
        <tr class="js-no-results no-results" style="display: none">
          <th colspan="2">No matching files</th>
        </tr>
        <tbody class="js-results-list">
        </tbody>
      </table>
    </div>

    <div id="repo_details" class="metabox clearfix">
      <div id="repo_details_loader" class="metabox-loader" style="display:none">Sending Request&hellip;</div>

        <a href="/jaz303/jquery-grab-bag/downloads" class="download-source" id="download_button" title="Download source, tagged packages and binaries."><span class="icon"></span>Downloads</a>

      <div id="repository_desc_wrapper">
      <div id="repository_description" rel="repository_description_edit">
        
          <p>Miscellaneous small jQuery plugins
            <span id="read_more" style="display:none">&mdash; <a href="#readme">Read more</a></span>
          </p>
        
      </div>

      <div id="repository_description_edit" style="display:none;" class="inline-edit">
        <form action="/jaz303/jquery-grab-bag/admin/update" method="post"><div style="margin:0;padding:0"><input name="authenticity_token" type="hidden" value="cef9227961bb8e0c8903fb11bfd38daf0c96e9e9" /></div>
          <input type="hidden" name="field" value="repository_description">
          <input type="text" class="textfield" name="value" value="Miscellaneous small jQuery plugins">
          <div class="form-actions">
            <button class="minibutton"><span>Save</span></button> &nbsp; <a href="#" class="cancel">Cancel</a>
          </div>
        </form>
      </div>

      
      <div class="repository-homepage" id="repository_homepage" rel="repository_homepage_edit">
        <p><a href="http://onehackoranother.com/projects/jquery/jquery-grab-bag/" rel="nofollow">http://onehackoranother.com/projects/jquery/jquery-grab-bag/</a></p>
      </div>

      <div id="repository_homepage_edit" style="display:none;" class="inline-edit">
        <form action="/jaz303/jquery-grab-bag/admin/update" method="post"><div style="margin:0;padding:0"><input name="authenticity_token" type="hidden" value="cef9227961bb8e0c8903fb11bfd38daf0c96e9e9" /></div>
          <input type="hidden" name="field" value="repository_homepage">
          <input type="text" class="textfield" name="value" value="http://onehackoranother.com/projects/jquery/jquery-grab-bag/">
          <div class="form-actions">
            <button class="minibutton"><span>Save</span></button> &nbsp; <a href="#" class="cancel">Cancel</a>
          </div>
        </form>
      </div>
      </div>
      <div class="rule "></div>
            <div id="url_box" class="url-box">
        <ul class="clone-urls">
          
            
            <li id="http_clone_url"><a href="https://github.com/jaz303/jquery-grab-bag.git" data-permissions="Read-Only">HTTP</a></li>
            <li id="public_clone_url"><a href="git://github.com/jaz303/jquery-grab-bag.git" data-permissions="Read-Only">Git Read-Only</a></li>
          
          
        </ul>
        <input type="text" spellcheck="false" id="url_field" class="url-field" />
              <span style="display:none" id="url_box_clippy"></span>
      <span id="clippy_tooltip_url_box_clippy" class="clippy-tooltip tooltipped" title="copy to clipboard">
      <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
              width="14"
              height="14"
              class="clippy"
              id="clippy" >
      <param name="movie" value="https://assets1.github.com/flash/clippy.swf?v5"/>
      <param name="allowScriptAccess" value="always" />
      <param name="quality" value="high" />
      <param name="scale" value="noscale" />
      <param NAME="FlashVars" value="id=url_box_clippy&amp;copied=&amp;copyto=">
      <param name="bgcolor" value="#FFFFFF">
      <param name="wmode" value="opaque">
      <embed src="https://assets1.github.com/flash/clippy.swf?v5"
             width="14"
             height="14"
             name="clippy"
             quality="high"
             allowScriptAccess="always"
             type="application/x-shockwave-flash"
             pluginspage="http://www.macromedia.com/go/getflashplayer"
             FlashVars="id=url_box_clippy&amp;copied=&amp;copyto="
             bgcolor="#FFFFFF"
             wmode="opaque"
      />
      </object>
      </span>

        <p id="url_description">This URL has <strong>Read+Write</strong> access</p>
      </div>
    </div>


        

      </div><!-- /.pagehead -->

      





<script type="text/javascript">
  GitHub.downloadRepo = '/jaz303/jquery-grab-bag/archives/master'
  GitHub.revType = "master"

  GitHub.controllerName = "blob"
  GitHub.actionName     = "show"
  GitHub.currentAction  = "blob#show"

  

  
</script>






<div class="flash-messages"></div>


  <div id="commit">
    <div class="group">
        
  <div class="envelope commit">
    <div class="human">
      
        <div class="message"><pre><a href="/jaz303/jquery-grab-bag/commit/307fbfedfb69f594a94048c554c11249bedcd77b">Merge branch 'master' of https://github.com/leereilly/jquery-grab-bag into leereilly-master</a> </pre></div>
      

      <div class="actor">
        <div class="gravatar">
          
          <img src="https://secure.gravatar.com/avatar/3f51727357dd2eeb7fbb59993e0fca29?s=140&d=https://github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" alt="" width="30" height="30"  />
        </div>
        <div class="name"><a href="/jaz303">jaz303</a> <span>(author)</span></div>
        <div class="date">
          <abbr class="relatize" title="2010-11-03 14:48:37">Wed Nov 03 14:48:37 -0700 2010</abbr>
        </div>
      </div>

      

    </div>
    <div class="machine">
      <span>c</span>ommit&nbsp;&nbsp;<a href="/jaz303/jquery-grab-bag/commit/307fbfedfb69f594a94048c554c11249bedcd77b" hotkey="c">307fbfedfb69f594a940</a><br />
      <span>t</span>ree&nbsp;&nbsp;&nbsp;&nbsp;<a href="/jaz303/jquery-grab-bag/tree/307fbfedfb69f594a94048c554c11249bedcd77b" hotkey="t">8f7c30b2779a23f1547c</a><br />
      
        <span>p</span>arent&nbsp;
        
        <a href="/jaz303/jquery-grab-bag/tree/d53e1176e854e4e5083a8aa217ab855cabb51b65" hotkey="p">d53e1176e854e4e5083a</a>
      
        <span>p</span>arent&nbsp;
        
        <a href="/jaz303/jquery-grab-bag/tree/65bc8b28aef752463068481f00784049c8a92232" hotkey="p">65bc8b28aef752463068</a>
      

    </div>
  </div>

    </div>
  </div>



  <div id="slider">

  

    <div class="breadcrumb" data-path="javascripts/jquery.autogrow-textarea.js/">
      <b><a href="/jaz303/jquery-grab-bag/tree/307fbfedfb69f594a94048c554c11249bedcd77b">jquery-grab-bag</a></b> / <a href="/jaz303/jquery-grab-bag/tree/307fbfedfb69f594a94048c554c11249bedcd77b/javascripts">javascripts</a> / jquery.autogrow-textarea.js       <span style="display:none" id="clippy_304">javascripts/jquery.autogrow-textarea.js</span>
      
      <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
              width="110"
              height="14"
              class="clippy"
              id="clippy" >
      <param name="movie" value="https://assets3.github.com/flash/clippy.swf?v5"/>
      <param name="allowScriptAccess" value="always" />
      <param name="quality" value="high" />
      <param name="scale" value="noscale" />
      <param NAME="FlashVars" value="id=clippy_304&amp;copied=copied!&amp;copyto=copy to clipboard">
      <param name="bgcolor" value="#FFFFFF">
      <param name="wmode" value="opaque">
      <embed src="https://assets3.github.com/flash/clippy.swf?v5"
             width="110"
             height="14"
             name="clippy"
             quality="high"
             allowScriptAccess="always"
             type="application/x-shockwave-flash"
             pluginspage="http://www.macromedia.com/go/getflashplayer"
             FlashVars="id=clippy_304&amp;copied=copied!&amp;copyto=copy to clipboard"
             bgcolor="#FFFFFF"
             wmode="opaque"
      />
      </object>
      

    </div>

    <div class="frames">
      <div class="frame frame-center" data-path="javascripts/jquery.autogrow-textarea.js/">
        
          <ul class="big-actions">
            
            <li><a class="file-edit-link minibutton" href="/jaz303/jquery-grab-bag/file-edit/__current_ref__/javascripts/jquery.autogrow-textarea.js"><span>Edit this file</span></a></li>
          </ul>
        

        <div id="files">
          <div class="file">
            <div class="meta">
              <div class="info">
                <span class="icon"><img alt="Txt" height="16" src="https://assets1.github.com/images/icons/txt.png?4280dfe5064c06d9f0d31c3a544b6b90b31697fb" width="16" /></span>
                <span class="mode" title="File Mode">100644</span>
                
                  <span>54 lines (39 sloc)</span>
                
                <span>1.921 kb</span>
              </div>
              <ul class="actions">
                <li><a href="/jaz303/jquery-grab-bag/raw/master/javascripts/jquery.autogrow-textarea.js" id="raw-url">raw</a></li>
                
                  <li><a href="/jaz303/jquery-grab-bag/blame/master/javascripts/jquery.autogrow-textarea.js">blame</a></li>
                
                <li><a href="/jaz303/jquery-grab-bag/commits/master/javascripts/jquery.autogrow-textarea.js">history</a></li>
              </ul>
            </div>
            
  <div class="data type-javascript">
    
      <table cellpadding="0" cellspacing="0">
        <tr>
          <td>
            <pre class="line_numbers"><span id="L1" rel="#L1">1</span>
<span id="L2" rel="#L2">2</span>
<span id="L3" rel="#L3">3</span>
<span id="L4" rel="#L4">4</span>
<span id="L5" rel="#L5">5</span>
<span id="L6" rel="#L6">6</span>
<span id="L7" rel="#L7">7</span>
<span id="L8" rel="#L8">8</span>
<span id="L9" rel="#L9">9</span>
<span id="L10" rel="#L10">10</span>
<span id="L11" rel="#L11">11</span>
<span id="L12" rel="#L12">12</span>
<span id="L13" rel="#L13">13</span>
<span id="L14" rel="#L14">14</span>
<span id="L15" rel="#L15">15</span>
<span id="L16" rel="#L16">16</span>
<span id="L17" rel="#L17">17</span>
<span id="L18" rel="#L18">18</span>
<span id="L19" rel="#L19">19</span>
<span id="L20" rel="#L20">20</span>
<span id="L21" rel="#L21">21</span>
<span id="L22" rel="#L22">22</span>
<span id="L23" rel="#L23">23</span>
<span id="L24" rel="#L24">24</span>
<span id="L25" rel="#L25">25</span>
<span id="L26" rel="#L26">26</span>
<span id="L27" rel="#L27">27</span>
<span id="L28" rel="#L28">28</span>
<span id="L29" rel="#L29">29</span>
<span id="L30" rel="#L30">30</span>
<span id="L31" rel="#L31">31</span>
<span id="L32" rel="#L32">32</span>
<span id="L33" rel="#L33">33</span>
<span id="L34" rel="#L34">34</span>
<span id="L35" rel="#L35">35</span>
<span id="L36" rel="#L36">36</span>
<span id="L37" rel="#L37">37</span>
<span id="L38" rel="#L38">38</span>
<span id="L39" rel="#L39">39</span>
<span id="L40" rel="#L40">40</span>
<span id="L41" rel="#L41">41</span>
<span id="L42" rel="#L42">42</span>
<span id="L43" rel="#L43">43</span>
<span id="L44" rel="#L44">44</span>
<span id="L45" rel="#L45">45</span>
<span id="L46" rel="#L46">46</span>
<span id="L47" rel="#L47">47</span>
<span id="L48" rel="#L48">48</span>
<span id="L49" rel="#L49">49</span>
<span id="L50" rel="#L50">50</span>
<span id="L51" rel="#L51">51</span>
<span id="L52" rel="#L52">52</span>
<span id="L53" rel="#L53">53</span>
<span id="L54" rel="#L54">54</span>
</pre>
          </td>
          <td width="100%">
            
              
                <div class="highlight"><pre><div class='line' id='LC1'><span class="p">(</span><span class="kd">function</span><span class="p">(</span><span class="nx">$</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC2'><br/></div><div class='line' id='LC3'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="cm">/*</span></div><div class='line' id='LC4'><span class="cm">     * Auto-growing textareas; technique ripped from Facebook</span></div><div class='line' id='LC5'><span class="cm">     */</span></div><div class='line' id='LC6'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">$</span><span class="p">.</span><span class="nx">fn</span><span class="p">.</span><span class="nx">autogrow</span> <span class="o">=</span> <span class="kd">function</span><span class="p">(</span><span class="nx">options</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC7'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC8'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">this</span><span class="p">.</span><span class="nx">filter</span><span class="p">(</span><span class="s1">&#39;textarea&#39;</span><span class="p">).</span><span class="nx">each</span><span class="p">(</span><span class="kd">function</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC9'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC10'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="kd">var</span> <span class="nx">$this</span>       <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="k">this</span><span class="p">),</span></div><div class='line' id='LC11'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">minHeight</span>   <span class="o">=</span> <span class="nx">$this</span><span class="p">.</span><span class="nx">height</span><span class="p">(),</span></div><div class='line' id='LC12'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">lineHeight</span>  <span class="o">=</span> <span class="nx">$this</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;lineHeight&#39;</span><span class="p">);</span></div><div class='line' id='LC13'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC14'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="kd">var</span> <span class="nx">shadow</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="s1">&#39;&lt;div&gt;&lt;/div&gt;&#39;</span><span class="p">).</span><span class="nx">css</span><span class="p">({</span></div><div class='line' id='LC15'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">position</span><span class="o">:</span>   <span class="s1">&#39;absolute&#39;</span><span class="p">,</span></div><div class='line' id='LC16'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">top</span><span class="o">:</span>        <span class="o">-</span><span class="mi">10000</span><span class="p">,</span></div><div class='line' id='LC17'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">left</span><span class="o">:</span>       <span class="o">-</span><span class="mi">10000</span><span class="p">,</span></div><div class='line' id='LC18'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">width</span><span class="o">:</span>      <span class="nx">$</span><span class="p">(</span><span class="k">this</span><span class="p">).</span><span class="nx">width</span><span class="p">()</span> <span class="o">-</span> <span class="nb">parseInt</span><span class="p">(</span><span class="nx">$this</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;paddingLeft&#39;</span><span class="p">))</span> <span class="o">-</span> <span class="nb">parseInt</span><span class="p">(</span><span class="nx">$this</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;paddingRight&#39;</span><span class="p">)),</span></div><div class='line' id='LC19'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">fontSize</span><span class="o">:</span>   <span class="nx">$this</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;fontSize&#39;</span><span class="p">),</span></div><div class='line' id='LC20'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">fontFamily</span><span class="o">:</span> <span class="nx">$this</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;fontFamily&#39;</span><span class="p">),</span></div><div class='line' id='LC21'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">lineHeight</span><span class="o">:</span> <span class="nx">$this</span><span class="p">.</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;lineHeight&#39;</span><span class="p">),</span></div><div class='line' id='LC22'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">resize</span><span class="o">:</span>     <span class="s1">&#39;none&#39;</span></div><div class='line' id='LC23'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}).</span><span class="nx">appendTo</span><span class="p">(</span><span class="nb">document</span><span class="p">.</span><span class="nx">body</span><span class="p">);</span></div><div class='line' id='LC24'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC25'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="kd">var</span> <span class="nx">update</span> <span class="o">=</span> <span class="kd">function</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC26'>&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC27'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="kd">var</span> <span class="nx">times</span> <span class="o">=</span> <span class="kd">function</span><span class="p">(</span><span class="nx">string</span><span class="p">,</span> <span class="nx">number</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC28'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">for</span> <span class="p">(</span><span class="kd">var</span> <span class="nx">i</span> <span class="o">=</span> <span class="mi">0</span><span class="p">,</span> <span class="nx">r</span> <span class="o">=</span> <span class="s1">&#39;&#39;</span><span class="p">;</span> <span class="nx">i</span> <span class="o">&lt;</span> <span class="nx">number</span><span class="p">;</span> <span class="nx">i</span> <span class="o">++</span><span class="p">)</span> <span class="nx">r</span> <span class="o">+=</span> <span class="nx">string</span><span class="p">;</span></div><div class='line' id='LC29'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nx">r</span><span class="p">;</span></div><div class='line' id='LC30'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">};</span></div><div class='line' id='LC31'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC32'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="kd">var</span> <span class="nx">val</span> <span class="o">=</span> <span class="k">this</span><span class="p">.</span><span class="nx">value</span><span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/&lt;/g</span><span class="p">,</span> <span class="s1">&#39;&amp;lt;&#39;</span><span class="p">)</span></div><div class='line' id='LC33'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/&gt;/g</span><span class="p">,</span> <span class="s1">&#39;&amp;gt;&#39;</span><span class="p">)</span></div><div class='line' id='LC34'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/&amp;/g</span><span class="p">,</span> <span class="s1">&#39;&amp;amp;&#39;</span><span class="p">)</span></div><div class='line' id='LC35'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/\n$/</span><span class="p">,</span> <span class="s1">&#39;&lt;br/&gt;&amp;nbsp;&#39;</span><span class="p">)</span></div><div class='line' id='LC36'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/\n/g</span><span class="p">,</span> <span class="s1">&#39;&lt;br/&gt;&#39;</span><span class="p">)</span></div><div class='line' id='LC37'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/ {2,}/g</span><span class="p">,</span> <span class="kd">function</span><span class="p">(</span><span class="nx">space</span><span class="p">)</span> <span class="p">{</span> <span class="k">return</span> <span class="nx">times</span><span class="p">(</span><span class="s1">&#39;&amp;nbsp;&#39;</span><span class="p">,</span> <span class="nx">space</span><span class="p">.</span><span class="nx">length</span> <span class="o">-</span><span class="mi">1</span><span class="p">)</span> <span class="o">+</span> <span class="s1">&#39; &#39;</span> <span class="p">});</span></div><div class='line' id='LC38'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC39'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">shadow</span><span class="p">.</span><span class="nx">html</span><span class="p">(</span><span class="nx">val</span><span class="p">);</span></div><div class='line' id='LC40'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">$</span><span class="p">(</span><span class="k">this</span><span class="p">).</span><span class="nx">css</span><span class="p">(</span><span class="s1">&#39;height&#39;</span><span class="p">,</span> <span class="nb">Math</span><span class="p">.</span><span class="nx">max</span><span class="p">(</span><span class="nx">shadow</span><span class="p">.</span><span class="nx">height</span><span class="p">()</span> <span class="o">+</span> <span class="mi">20</span><span class="p">,</span> <span class="nx">minHeight</span><span class="p">));</span></div><div class='line' id='LC41'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC42'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC43'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC44'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">$</span><span class="p">(</span><span class="k">this</span><span class="p">).</span><span class="nx">change</span><span class="p">(</span><span class="nx">update</span><span class="p">).</span><span class="nx">keyup</span><span class="p">(</span><span class="nx">update</span><span class="p">).</span><span class="nx">keydown</span><span class="p">(</span><span class="nx">update</span><span class="p">);</span></div><div class='line' id='LC45'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC46'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">update</span><span class="p">.</span><span class="nx">apply</span><span class="p">(</span><span class="k">this</span><span class="p">);</span></div><div class='line' id='LC47'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC48'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">});</span></div><div class='line' id='LC49'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC50'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="k">this</span><span class="p">;</span></div><div class='line' id='LC51'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC52'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC53'>&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC54'><span class="p">})(</span><span class="nx">jQuery</span><span class="p">);</span></div></pre></div>
              
            
          </td>
        </tr>
      </table>
    
  </div>


          </div>
        </div>
      </div>
    </div>
  

  </div>


<div class="frame frame-loading" style="display:none;">
  <img src="/images/modules/ajax/big_spinner_336699.gif">
</div>
    </div>
  
      
    </div>

    <div id="footer" class="clearfix">
      <div class="site">
        <div class="sponsor">
          <a href="http://www.rackspace.com" class="logo">
            <img alt="Dedicated Server" src="https://assets2.github.com/images/modules/footer/rackspace_logo.png?v2?a1df53439d4f181c6154c3d5f1c3056b24eb59c5" />
          </a>
          Powered by the <a href="http://www.rackspace.com ">Dedicated
          Servers</a> and<br/> <a href="http://www.rackspacecloud.com">Cloud
          Computing</a> of Rackspace Hosting<span>&reg;</span>
        </div>

        <ul class="links">
          <li class="blog"><a href="https://github.com/blog">Blog</a></li>
          <li><a href="http://support.github.com">Support</a></li>
          <li><a href="https://github.com/training">Training</a></li>
          <li><a href="http://jobs.github.com">Job Board</a></li>
          <li><a href="http://shop.github.com">Shop</a></li>
          <li><a href="https://github.com/contact">Contact</a></li>
          <li><a href="http://develop.github.com">API</a></li>
          <li><a href="http://status.github.com">Status</a></li>
        </ul>
        <ul class="sosueme">
          <li class="main">&copy; 2011 <span id="_rrt" title="0.06006s from fe2.rs.github.com">GitHub</span> Inc. All rights reserved.</li>
          <li><a href="/site/terms">Terms of Service</a></li>
          <li><a href="/site/privacy">Privacy</a></li>
          <li><a href="https://github.com/security">Security</a></li>
        </ul>
      </div>
    </div><!-- /#footer -->

    
      
      
        <!-- current locale:  -->
        <div class="locales">
          <div class="site">

            <ul class="choices clearfix limited-locales">
              <li><span class="current">English</span></li>
              
                  <li><a rel="nofollow" href="?locale=de">Deutsch</a></li>
              
                  <li><a rel="nofollow" href="?locale=fr">Français</a></li>
              
                  <li><a rel="nofollow" href="?locale=ja">日本語</a></li>
              
                  <li><a rel="nofollow" href="?locale=pt-BR">Português (BR)</a></li>
              
                  <li><a rel="nofollow" href="?locale=ru">Русский</a></li>
              
                  <li><a rel="nofollow" href="?locale=zh">中文</a></li>
              
              <li class="all"><a href="#" class="minibutton btn-forward js-all-locales"><span><span class="icon"></span>See all available languages</span></a></li>
            </ul>

            <div class="all-locales clearfix">
              <h3>Your current locale selection: <strong>English</strong>. Choose another?</h3>
              
              
                <ul class="choices">
                  
                      <li><a rel="nofollow" href="?locale=en">English</a></li>
                  
                      <li><a rel="nofollow" href="?locale=af">Afrikaans</a></li>
                  
                      <li><a rel="nofollow" href="?locale=ca">Català</a></li>
                  
                      <li><a rel="nofollow" href="?locale=cs">Čeština</a></li>
                  
                </ul>
              
                <ul class="choices">
                  
                      <li><a rel="nofollow" href="?locale=de">Deutsch</a></li>
                  
                      <li><a rel="nofollow" href="?locale=es">Español</a></li>
                  
                      <li><a rel="nofollow" href="?locale=fr">Français</a></li>
                  
                      <li><a rel="nofollow" href="?locale=hr">Hrvatski</a></li>
                  
                </ul>
              
                <ul class="choices">
                  
                      <li><a rel="nofollow" href="?locale=id">Indonesia</a></li>
                  
                      <li><a rel="nofollow" href="?locale=it">Italiano</a></li>
                  
                      <li><a rel="nofollow" href="?locale=ja">日本語</a></li>
                  
                      <li><a rel="nofollow" href="?locale=nl">Nederlands</a></li>
                  
                </ul>
              
                <ul class="choices">
                  
                      <li><a rel="nofollow" href="?locale=no">Norsk</a></li>
                  
                      <li><a rel="nofollow" href="?locale=pl">Polski</a></li>
                  
                      <li><a rel="nofollow" href="?locale=pt-BR">Português (BR)</a></li>
                  
                      <li><a rel="nofollow" href="?locale=ru">Русский</a></li>
                  
                </ul>
              
                <ul class="choices">
                  
                      <li><a rel="nofollow" href="?locale=sr">Српски</a></li>
                  
                      <li><a rel="nofollow" href="?locale=sv">Svenska</a></li>
                  
                      <li><a rel="nofollow" href="?locale=zh">中文</a></li>
                  
                </ul>
              
            </div>

          </div>
          <div class="fade"></div>
        </div>
      
    

    <script>window._auth_token = "cef9227961bb8e0c8903fb11bfd38daf0c96e9e9"</script>
    <div id="keyboard_shortcuts_pane" style="display:none">
  <h2>Keyboard Shortcuts</h2>

  <div class="columns threecols">
    <div class="column first">
      <h3>Site wide shortcuts</h3>
      <dl class="keyboard-mappings">
        <dt>s</dt>
        <dd>Focus site search</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>?</dt>
        <dd>Bring up this help dialog</dd>
      </dl>
    </div><!-- /.column.first -->
    <div class="column middle">
      <h3>Commit list</h3>
      <dl class="keyboard-mappings">
        <dt>j</dt>
        <dd>Move selected down</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>k</dt>
        <dd>Move selected up</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>t</dt>
        <dd>Open tree</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>p</dt>
        <dd>Open parent</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>c <em>or</em> o <em>or</em> enter</dt>
        <dd>Open commit</dd>
      </dl>
    </div><!-- /.column.first -->
    <div class="column last">
      <h3>Pull request list</h3>
      <dl class="keyboard-mappings">
        <dt>j</dt>
        <dd>Move selected down</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>k</dt>
        <dd>Move selected up</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>o <em>or</em> enter</dt>
        <dd>Open issue</dd>
      </dl>
    </div><!-- /.columns.last -->
  </div><!-- /.columns.equacols -->

  <div class="rule"></div>

  <h3>Issues</h3>

  <div class="columns threecols">
    <div class="column first">
      <dl class="keyboard-mappings">
        <dt>j</dt>
        <dd>Move selected down</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>k</dt>
        <dd>Move selected up</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>x</dt>
        <dd>Toggle select target</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>o <em>or</em> enter</dt>
        <dd>Open issue</dd>
      </dl>
    </div><!-- /.column.first -->
    <div class="column middle">
      <dl class="keyboard-mappings">
        <dt>I</dt>
        <dd>Mark selected as read</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>U</dt>
        <dd>Mark selected as unread</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>e</dt>
        <dd>Close selected</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>y</dt>
        <dd>Remove selected from view</dd>
      </dl>
    </div><!-- /.column.middle -->
    <div class="column last">
      <dl class="keyboard-mappings">
        <dt>c</dt>
        <dd>Create issue</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>l</dt>
        <dd>Create label</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>i</dt>
        <dd>Back to inbox</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>u</dt>
        <dd>Back to issues</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>/</dt>
        <dd>Focus issues search</dd>
      </dl>
    </div>
  </div>

  <div class="rule"></div>

  <h3>Network Graph</h3>
  <div class="columns equacols">
    <div class="column first">
      <dl class="keyboard-mappings">
        <dt>← <em>or</em> h</dt>
        <dd>Scroll left</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>→ <em>or</em> l</dt>
        <dd>Scroll right</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>↑ <em>or</em> k</dt>
        <dd>Scroll up</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>↓ <em>or</em> j</dt>
        <dd>Scroll down</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>t</dt>
        <dd>Toggle visibility of head labels</dd>
      </dl>
    </div><!-- /.column.first -->
    <div class="column last">
      <dl class="keyboard-mappings">
        <dt>shift ← <em>or</em> shift h</dt>
        <dd>Scroll all the way left</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>shift → <em>or</em> shift l</dt>
        <dd>Scroll all the way right</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>shift ↑ <em>or</em> shift k</dt>
        <dd>Scroll all the way up</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>shift ↓ <em>or</em> shift j</dt>
        <dd>Scroll all the way down</dd>
      </dl>
    </div><!-- /.column.last -->
  </div>

</div>
    

    <!--[if IE 8]>
    <script type="text/javascript" charset="utf-8">
      $(document.body).addClass("ie8")
    </script>
    <![endif]-->

    <!--[if IE 7]>
    <script type="text/javascript" charset="utf-8">
      $(document.body).addClass("ie7")
    </script>
    <![endif]-->

    
    <script type='text/javascript'>mpq.push(['track', 'Viewed entice banner']);</script>
    
  </body>
</html>

