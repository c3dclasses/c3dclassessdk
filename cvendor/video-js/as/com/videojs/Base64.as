




<!DOCTYPE html>
<html>
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# object: http://ogp.me/ns/object# article: http://ogp.me/ns/article# profile: http://ogp.me/ns/profile#">
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>video-js-swf/src/com/videojs/Base64.as at master · videojs/video-js-swf · GitHub</title>
    <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="GitHub" />
    <link rel="fluid-icon" href="https://github.com/fluidicon.png" title="GitHub" />
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-114.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-144.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144.png" />
    <meta property="fb:app_id" content="1401488693436528"/>

      <meta content="@github" name="twitter:site" /><meta content="summary" name="twitter:card" /><meta content="videojs/video-js-swf" name="twitter:title" /><meta content="video-js-swf - Custom Flash Player for VideoJS" name="twitter:description" /><meta content="https://2.gravatar.com/avatar/a11de74fd50ffdbc29ce5c584a61b105?d=https%3A%2F%2Fidenticons.github.com%2Ff04bb3480cc5cef259341a21fb35c643.png&amp;r=x&amp;s=400" name="twitter:image:src" />
<meta content="GitHub" property="og:site_name" /><meta content="object" property="og:type" /><meta content="https://2.gravatar.com/avatar/a11de74fd50ffdbc29ce5c584a61b105?d=https%3A%2F%2Fidenticons.github.com%2Ff04bb3480cc5cef259341a21fb35c643.png&amp;r=x&amp;s=400" property="og:image" /><meta content="videojs/video-js-swf" property="og:title" /><meta content="https://github.com/videojs/video-js-swf" property="og:url" /><meta content="video-js-swf - Custom Flash Player for VideoJS" property="og:description" />

    <meta name="hostname" content="github-fe125-cp1-prd.iad.github.net">
    <meta name="ruby" content="ruby 2.1.0p0-github-tcmalloc (87c9373a41) [x86_64-linux]">
    <link rel="assets" href="https://github.global.ssl.fastly.net/">
    <link rel="conduit-xhr" href="https://ghconduit.com:25035/">
    <link rel="xhr-socket" href="/_sockets" />


    <meta name="msapplication-TileImage" content="/windows-tile.png" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="selected-link" value="repo_source" data-pjax-transient />
    <meta content="collector.githubapp.com" name="octolytics-host" /><meta content="collector-cdn.github.com" name="octolytics-script-host" /><meta content="github" name="octolytics-app-id" /><meta content="407C15C4:1986:17AEE94:5321F1D9" name="octolytics-dimension-request_id" />
    

    
    
    <link rel="icon" type="image/x-icon" href="https://github.global.ssl.fastly.net/favicon.ico" />

    <meta content="authenticity_token" name="csrf-param" />
<meta content="sIe28gvKhgaTq1dq9ly4cI84N1TxdmqBj7+50ebXlvA=" name="csrf-token" />

    <link href="https://github.global.ssl.fastly.net/assets/github-adcf123587b068f65ee2420a9a7988231694ba13.css" media="all" rel="stylesheet" type="text/css" />
    <link href="https://github.global.ssl.fastly.net/assets/github2-0348dd5317f4771e8b58634e380551ffcd576e31.css" media="all" rel="stylesheet" type="text/css" />
    


      <script crossorigin="anonymous" src="https://github.global.ssl.fastly.net/assets/frameworks-9acb89add4e173259bb0e9e81d36276a93db7af4.js" type="text/javascript"></script>
      <script async="async" crossorigin="anonymous" src="https://github.global.ssl.fastly.net/assets/github-e5fa8dd774789368e3a337cb0ef547bbcf93c563.js" type="text/javascript"></script>
      
      <meta http-equiv="x-pjax-version" content="448de3c3914c5572b0f4db341dd276ee">

        <link data-pjax-transient rel='permalink' href='/videojs/video-js-swf/blob/c3183e27e107b076603da0b53bc16591ca324434/src/com/videojs/Base64.as'>

  <meta name="description" content="video-js-swf - Custom Flash Player for VideoJS" />

  <meta content="3287189" name="octolytics-dimension-user_id" /><meta content="videojs" name="octolytics-dimension-user_login" /><meta content="2885491" name="octolytics-dimension-repository_id" /><meta content="videojs/video-js-swf" name="octolytics-dimension-repository_nwo" /><meta content="true" name="octolytics-dimension-repository_public" /><meta content="false" name="octolytics-dimension-repository_is_fork" /><meta content="2885491" name="octolytics-dimension-repository_network_root_id" /><meta content="videojs/video-js-swf" name="octolytics-dimension-repository_network_root_nwo" />
  <link href="https://github.com/videojs/video-js-swf/commits/master.atom" rel="alternate" title="Recent Commits to video-js-swf:master" type="application/atom+xml" />

  </head>


  <body class="logged_out  env-production windows vis-public page-blob">
    <a href="#start-of-content" class="accessibility-aid js-skip-to-content">Skip to content</a>
    <div class="wrapper">
      
      
      
      


      
      <div class="header header-logged-out">
  <div class="container clearfix">

    <a class="header-logo-wordmark" href="https://github.com/">
      <span class="mega-octicon octicon-logo-github"></span>
    </a>

    <div class="header-actions">
        <a class="button primary" href="/join">Sign up</a>
      <a class="button signin" href="/login?return_to=%2Fvideojs%2Fvideo-js-swf%2Fblob%2Fmaster%2Fsrc%2Fcom%2Fvideojs%2FBase64.as">Sign in</a>
    </div>

    <div class="command-bar js-command-bar  in-repository">

      <ul class="top-nav">
          <li class="explore"><a href="/explore">Explore</a></li>
        <li class="features"><a href="/features">Features</a></li>
          <li class="enterprise"><a href="https://enterprise.github.com/">Enterprise</a></li>
          <li class="blog"><a href="/blog">Blog</a></li>
      </ul>
        <form accept-charset="UTF-8" action="/search" class="command-bar-form" id="top_search_form" method="get">

<input type="text" data-hotkey=" s" name="q" id="js-command-bar-field" placeholder="Search or type a command" tabindex="1" autocapitalize="off"
    
    
      data-repo="videojs/video-js-swf"
      data-branch="master"
      data-sha="05afb74dd11cbb298b74d82478a9b0a7806a6656"
  >

    <input type="hidden" name="nwo" value="videojs/video-js-swf" />

    <div class="select-menu js-menu-container js-select-menu search-context-select-menu">
      <span class="minibutton select-menu-button js-menu-target" role="button" aria-haspopup="true">
        <span class="js-select-button">This repository</span>
      </span>

      <div class="select-menu-modal-holder js-menu-content js-navigation-container" aria-hidden="true">
        <div class="select-menu-modal">

          <div class="select-menu-item js-navigation-item js-this-repository-navigation-item selected">
            <span class="select-menu-item-icon octicon octicon-check"></span>
            <input type="radio" class="js-search-this-repository" name="search_target" value="repository" checked="checked" />
            <div class="select-menu-item-text js-select-button-text">This repository</div>
          </div> <!-- /.select-menu-item -->

          <div class="select-menu-item js-navigation-item js-all-repositories-navigation-item">
            <span class="select-menu-item-icon octicon octicon-check"></span>
            <input type="radio" name="search_target" value="global" />
            <div class="select-menu-item-text js-select-button-text">All repositories</div>
          </div> <!-- /.select-menu-item -->

        </div>
      </div>
    </div>

  <span class="help tooltipped tooltipped-s" aria-label="Show command bar help">
    <span class="octicon octicon-question"></span>
  </span>


  <input type="hidden" name="ref" value="cmdform">

</form>
    </div>

  </div>
</div>



      <div id="start-of-content" class="accessibility-aid"></div>
          <div class="site" itemscope itemtype="http://schema.org/WebPage">
    
    <div class="pagehead repohead instapaper_ignore readability-menu">
      <div class="container">
        

<ul class="pagehead-actions">


  <li>
    <a href="/login?return_to=%2Fvideojs%2Fvideo-js-swf"
    class="minibutton with-count js-toggler-target star-button tooltipped tooltipped-n"
    aria-label="You must be signed in to star a repository" rel="nofollow">
    <span class="octicon octicon-star"></span>Star
  </a>

    <a class="social-count js-social-count" href="/videojs/video-js-swf/stargazers">
      73
    </a>

  </li>

    <li>
      <a href="/login?return_to=%2Fvideojs%2Fvideo-js-swf"
        class="minibutton with-count js-toggler-target fork-button tooltipped tooltipped-n"
        aria-label="You must be signed in to fork a repository" rel="nofollow">
        <span class="octicon octicon-git-branch"></span>Fork
      </a>
      <a href="/videojs/video-js-swf/network" class="social-count">
        71
      </a>
    </li>
</ul>

        <h1 itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="entry-title public">
          <span class="repo-label"><span>public</span></span>
          <span class="mega-octicon octicon-repo"></span>
          <span class="author">
            <a href="/videojs" class="url fn" itemprop="url" rel="author"><span itemprop="title">videojs</span></a>
          </span>
          <span class="repohead-name-divider">/</span>
          <strong><a href="/videojs/video-js-swf" class="js-current-repository js-repo-home-link">video-js-swf</a></strong>

          <span class="page-context-loader">
            <img alt="Octocat-spinner-32" height="16" src="https://github.global.ssl.fastly.net/images/spinners/octocat-spinner-32.gif" width="16" />
          </span>

        </h1>
      </div><!-- /.container -->
    </div><!-- /.repohead -->

    <div class="container">
      <div class="repository-with-sidebar repo-container new-discussion-timeline js-new-discussion-timeline  ">
        <div class="repository-sidebar clearfix">
            

<div class="sunken-menu vertical-right repo-nav js-repo-nav js-repository-container-pjax js-octicon-loaders">
  <div class="sunken-menu-contents">
    <ul class="sunken-menu-group">
      <li class="tooltipped tooltipped-w" aria-label="Code">
        <a href="/videojs/video-js-swf" aria-label="Code" class="selected js-selected-navigation-item sunken-menu-item" data-gotokey="c" data-pjax="true" data-selected-links="repo_source repo_downloads repo_commits repo_tags repo_branches /videojs/video-js-swf">
          <span class="octicon octicon-code"></span> <span class="full-word">Code</span>
          <img alt="Octocat-spinner-32" class="mini-loader" height="16" src="https://github.global.ssl.fastly.net/images/spinners/octocat-spinner-32.gif" width="16" />
</a>      </li>

        <li class="tooltipped tooltipped-w" aria-label="Issues">
          <a href="/videojs/video-js-swf/issues" aria-label="Issues" class="js-selected-navigation-item sunken-menu-item js-disable-pjax" data-gotokey="i" data-selected-links="repo_issues /videojs/video-js-swf/issues">
            <span class="octicon octicon-issue-opened"></span> <span class="full-word">Issues</span>
            <span class='counter'>39</span>
            <img alt="Octocat-spinner-32" class="mini-loader" height="16" src="https://github.global.ssl.fastly.net/images/spinners/octocat-spinner-32.gif" width="16" />
</a>        </li>

      <li class="tooltipped tooltipped-w" aria-label="Pull Requests">
        <a href="/videojs/video-js-swf/pulls" aria-label="Pull Requests" class="js-selected-navigation-item sunken-menu-item js-disable-pjax" data-gotokey="p" data-selected-links="repo_pulls /videojs/video-js-swf/pulls">
            <span class="octicon octicon-git-pull-request"></span> <span class="full-word">Pull Requests</span>
            <span class='counter'>5</span>
            <img alt="Octocat-spinner-32" class="mini-loader" height="16" src="https://github.global.ssl.fastly.net/images/spinners/octocat-spinner-32.gif" width="16" />
</a>      </li>


        <li class="tooltipped tooltipped-w" aria-label="Wiki">
          <a href="/videojs/video-js-swf/wiki" aria-label="Wiki" class="js-selected-navigation-item sunken-menu-item" data-pjax="true" data-selected-links="repo_wiki /videojs/video-js-swf/wiki">
            <span class="octicon octicon-book"></span> <span class="full-word">Wiki</span>
            <img alt="Octocat-spinner-32" class="mini-loader" height="16" src="https://github.global.ssl.fastly.net/images/spinners/octocat-spinner-32.gif" width="16" />
</a>        </li>
    </ul>
    <div class="sunken-menu-separator"></div>
    <ul class="sunken-menu-group">

      <li class="tooltipped tooltipped-w" aria-label="Pulse">
        <a href="/videojs/video-js-swf/pulse" aria-label="Pulse" class="js-selected-navigation-item sunken-menu-item" data-pjax="true" data-selected-links="pulse /videojs/video-js-swf/pulse">
          <span class="octicon octicon-pulse"></span> <span class="full-word">Pulse</span>
          <img alt="Octocat-spinner-32" class="mini-loader" height="16" src="https://github.global.ssl.fastly.net/images/spinners/octocat-spinner-32.gif" width="16" />
</a>      </li>

      <li class="tooltipped tooltipped-w" aria-label="Graphs">
        <a href="/videojs/video-js-swf/graphs" aria-label="Graphs" class="js-selected-navigation-item sunken-menu-item" data-pjax="true" data-selected-links="repo_graphs repo_contributors /videojs/video-js-swf/graphs">
          <span class="octicon octicon-graph"></span> <span class="full-word">Graphs</span>
          <img alt="Octocat-spinner-32" class="mini-loader" height="16" src="https://github.global.ssl.fastly.net/images/spinners/octocat-spinner-32.gif" width="16" />
</a>      </li>

      <li class="tooltipped tooltipped-w" aria-label="Network">
        <a href="/videojs/video-js-swf/network" aria-label="Network" class="js-selected-navigation-item sunken-menu-item js-disable-pjax" data-selected-links="repo_network /videojs/video-js-swf/network">
          <span class="octicon octicon-git-branch"></span> <span class="full-word">Network</span>
          <img alt="Octocat-spinner-32" class="mini-loader" height="16" src="https://github.global.ssl.fastly.net/images/spinners/octocat-spinner-32.gif" width="16" />
</a>      </li>
    </ul>


  </div>
</div>

              <div class="only-with-full-nav">
                

  

<div class="clone-url open"
  data-protocol-type="http"
  data-url="/users/set_protocol?protocol_selector=http&amp;protocol_type=clone">
  <h3><strong>HTTPS</strong> clone URL</h3>
  <div class="clone-url-box">
    <input type="text" class="clone js-url-field"
           value="https://github.com/videojs/video-js-swf.git" readonly="readonly">

    <span aria-label="copy to clipboard" class="js-zeroclipboard url-box-clippy minibutton zeroclipboard-button" data-clipboard-text="https://github.com/videojs/video-js-swf.git" data-copied-hint="copied!"><span class="octicon octicon-clippy"></span></span>
  </div>
</div>

  

<div class="clone-url "
  data-protocol-type="subversion"
  data-url="/users/set_protocol?protocol_selector=subversion&amp;protocol_type=clone">
  <h3><strong>Subversion</strong> checkout URL</h3>
  <div class="clone-url-box">
    <input type="text" class="clone js-url-field"
           value="https://github.com/videojs/video-js-swf" readonly="readonly">

    <span aria-label="copy to clipboard" class="js-zeroclipboard url-box-clippy minibutton zeroclipboard-button" data-clipboard-text="https://github.com/videojs/video-js-swf" data-copied-hint="copied!"><span class="octicon octicon-clippy"></span></span>
  </div>
</div>


<p class="clone-options">You can clone with
      <a href="#" class="js-clone-selector" data-protocol="http">HTTPS</a>
      or <a href="#" class="js-clone-selector" data-protocol="subversion">Subversion</a>.
  <span class="help tooltipped tooltipped-n" aria-label="Get help on which URL is right for you.">
    <a href="https://help.github.com/articles/which-remote-url-should-i-use">
    <span class="octicon octicon-question"></span>
    </a>
  </span>
</p>


  <a href="http://windows.github.com" class="minibutton sidebar-button" title="Save videojs/video-js-swf to your computer and use it in GitHub Desktop." aria-label="Save videojs/video-js-swf to your computer and use it in GitHub Desktop.">
    <span class="octicon octicon-device-desktop"></span>
    Clone in Desktop
  </a>

                <a href="/videojs/video-js-swf/archive/master.zip"
                   class="minibutton sidebar-button"
                   aria-label="Download videojs/video-js-swf as a zip file"
                   title="Download videojs/video-js-swf as a zip file"
                   rel="nofollow">
                  <span class="octicon octicon-cloud-download"></span>
                  Download ZIP
                </a>
              </div>
        </div><!-- /.repository-sidebar -->

        <div id="js-repo-pjax-container" class="repository-content context-loader-container" data-pjax-container>
          


<!-- blob contrib key: blob_contributors:v21:4ec65221ba8e9043757b1920bd149d5d -->

<p title="This is a placeholder element" class="js-history-link-replace hidden"></p>

<a href="/videojs/video-js-swf/find/master" data-pjax data-hotkey="t" class="js-show-file-finder" style="display:none">Show File Finder</a>

<div class="file-navigation">
  

<div class="select-menu js-menu-container js-select-menu" >
  <span class="minibutton select-menu-button js-menu-target" data-hotkey="w"
    data-master-branch="master"
    data-ref="master"
    role="button" aria-label="Switch branches or tags" tabindex="0" aria-haspopup="true">
    <span class="octicon octicon-git-branch"></span>
    <i>branch:</i>
    <span class="js-select-button">master</span>
  </span>

  <div class="select-menu-modal-holder js-menu-content js-navigation-container" data-pjax aria-hidden="true">

    <div class="select-menu-modal">
      <div class="select-menu-header">
        <span class="select-menu-title">Switch branches/tags</span>
        <span class="octicon octicon-remove-close js-menu-close"></span>
      </div> <!-- /.select-menu-header -->

      <div class="select-menu-filters">
        <div class="select-menu-text-filter">
          <input type="text" aria-label="Filter branches/tags" id="context-commitish-filter-field" class="js-filterable-field js-navigation-enable" placeholder="Filter branches/tags">
        </div>
        <div class="select-menu-tabs">
          <ul>
            <li class="select-menu-tab">
              <a href="#" data-tab-filter="branches" class="js-select-menu-tab">Branches</a>
            </li>
            <li class="select-menu-tab">
              <a href="#" data-tab-filter="tags" class="js-select-menu-tab">Tags</a>
            </li>
          </ul>
        </div><!-- /.select-menu-tabs -->
      </div><!-- /.select-menu-filters -->

      <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket" data-tab-filter="branches">

        <div data-filterable-for="context-commitish-filter-field" data-filterable-type="substring">


            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/videojs/video-js-swf/blob/add-context-menu/src/com/videojs/Base64.as"
                 data-name="add-context-menu"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target"
                 title="add-context-menu">add-context-menu</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/videojs/video-js-swf/blob/audio/src/com/videojs/Base64.as"
                 data-name="audio"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target"
                 title="audio">audio</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/videojs/video-js-swf/blob/feature/data-generation-updates/src/com/videojs/Base64.as"
                 data-name="feature/data-generation-updates"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target"
                 title="feature/data-generation-updates">feature/data-generation-updates</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/videojs/video-js-swf/blob/feature/hls/src/com/videojs/Base64.as"
                 data-name="feature/hls"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target"
                 title="feature/hls">feature/hls</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/videojs/video-js-swf/blob/feature/karma/src/com/videojs/Base64.as"
                 data-name="feature/karma"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target"
                 title="feature/karma">feature/karma</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/videojs/video-js-swf/blob/feature/loadstart/src/com/videojs/Base64.as"
                 data-name="feature/loadstart"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target"
                 title="feature/loadstart">feature/loadstart</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/videojs/video-js-swf/blob/feature/version-bind/src/com/videojs/Base64.as"
                 data-name="feature/version-bind"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target"
                 title="feature/version-bind">feature/version-bind</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/videojs/video-js-swf/blob/hotfix/grunt-npm/src/com/videojs/Base64.as"
                 data-name="hotfix/grunt-npm"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target"
                 title="hotfix/grunt-npm">hotfix/grunt-npm</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/videojs/video-js-swf/blob/mangui/src/com/videojs/Base64.as"
                 data-name="mangui"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target"
                 title="mangui">mangui</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item selected">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/videojs/video-js-swf/blob/master/src/com/videojs/Base64.as"
                 data-name="master"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target"
                 title="master">master</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/videojs/video-js-swf/blob/media-source/src/com/videojs/Base64.as"
                 data-name="media-source"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target"
                 title="media-source">media-source</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/videojs/video-js-swf/blob/stable/src/com/videojs/Base64.as"
                 data-name="stable"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target"
                 title="stable">stable</a>
            </div> <!-- /.select-menu-item -->
        </div>

          <div class="select-menu-no-results">Nothing to show</div>
      </div> <!-- /.select-menu-list -->

      <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket" data-tab-filter="tags">
        <div data-filterable-for="context-commitish-filter-field" data-filterable-type="substring">


            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/videojs/video-js-swf/tree/v4.4.0/src/com/videojs/Base64.as"
                 data-name="v4.4.0"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target"
                 title="v4.4.0">v4.4.0</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/videojs/video-js-swf/tree/v4.3.5/src/com/videojs/Base64.as"
                 data-name="v4.3.5"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target"
                 title="v4.3.5">v4.3.5</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/videojs/video-js-swf/tree/v4.3.4/src/com/videojs/Base64.as"
                 data-name="v4.3.4"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target"
                 title="v4.3.4">v4.3.4</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/videojs/video-js-swf/tree/v4.3.3/src/com/videojs/Base64.as"
                 data-name="v4.3.3"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target"
                 title="v4.3.3">v4.3.3</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/videojs/video-js-swf/tree/v4.3.2/src/com/videojs/Base64.as"
                 data-name="v4.3.2"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target"
                 title="v4.3.2">v4.3.2</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/videojs/video-js-swf/tree/v4.3.1/src/com/videojs/Base64.as"
                 data-name="v4.3.1"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target"
                 title="v4.3.1">v4.3.1</a>
            </div> <!-- /.select-menu-item -->
        </div>

        <div class="select-menu-no-results">Nothing to show</div>
      </div> <!-- /.select-menu-list -->

    </div> <!-- /.select-menu-modal -->
  </div> <!-- /.select-menu-modal-holder -->
</div> <!-- /.select-menu -->

  <div class="breadcrumb">
    <span class='repo-root js-repo-root'><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/videojs/video-js-swf" data-branch="master" data-direction="back" data-pjax="true" itemscope="url"><span itemprop="title">video-js-swf</span></a></span></span><span class="separator"> / </span><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/videojs/video-js-swf/tree/master/src" data-branch="master" data-direction="back" data-pjax="true" itemscope="url"><span itemprop="title">src</span></a></span><span class="separator"> / </span><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/videojs/video-js-swf/tree/master/src/com" data-branch="master" data-direction="back" data-pjax="true" itemscope="url"><span itemprop="title">com</span></a></span><span class="separator"> / </span><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/videojs/video-js-swf/tree/master/src/com/videojs" data-branch="master" data-direction="back" data-pjax="true" itemscope="url"><span itemprop="title">videojs</span></a></span><span class="separator"> / </span><strong class="final-path">Base64.as</strong> <span aria-label="copy to clipboard" class="js-zeroclipboard minibutton zeroclipboard-button" data-clipboard-text="src/com/videojs/Base64.as" data-copied-hint="copied!"><span class="octicon octicon-clippy"></span></span>
  </div>
</div>


  <div class="commit commit-loader file-history-tease js-deferred-content" data-url="/videojs/video-js-swf/contributors/master/src/com/videojs/Base64.as">
    Fetching contributors…

    <div class="participation">
      <p class="loader-loading"><img alt="Octocat-spinner-32-eaf2f5" height="16" src="https://github.global.ssl.fastly.net/images/spinners/octocat-spinner-32-EAF2F5.gif" width="16" /></p>
      <p class="loader-error">Cannot retrieve contributors at this time</p>
    </div>
  </div>

<div class="file-box">
  <div class="file">
    <div class="meta clearfix">
      <div class="info file-name">
        <span class="icon"><b class="octicon octicon-file-text"></b></span>
        <span class="mode" title="File Mode">file</span>
        <span class="meta-divider"></span>
          <span>109 lines (93 sloc)</span>
          <span class="meta-divider"></span>
        <span>4.416 kb</span>
      </div>
      <div class="actions">
        <div class="button-group">
            <a class="minibutton tooltipped tooltipped-w"
               href="http://windows.github.com" aria-label="Open this file in GitHub for Windows">
                <span class="octicon octicon-device-desktop"></span> Open
            </a>
              <a class="minibutton disabled tooltipped tooltipped-w" href="#"
                 aria-label="You must be signed in to make or propose changes">Edit</a>
          <a href="/videojs/video-js-swf/raw/master/src/com/videojs/Base64.as" class="button minibutton " id="raw-url">Raw</a>
            <a href="/videojs/video-js-swf/blame/master/src/com/videojs/Base64.as" class="button minibutton js-update-url-with-hash">Blame</a>
          <a href="/videojs/video-js-swf/commits/master/src/com/videojs/Base64.as" class="button minibutton " rel="nofollow">History</a>
        </div><!-- /.button-group -->
          <a class="minibutton danger disabled empty-icon tooltipped tooltipped-w" href="#"
             aria-label="You must be signed in to make or propose changes">
          Delete
        </a>
      </div><!-- /.actions -->
    </div>
        <div class="blob-wrapper data type-actionscript js-blob-data">
        <table class="file-code file-diff tab-size-8">
          <tr class="file-code-line">
            <td class="blob-line-nums">
              <span id="L1" rel="#L1">1</span>
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
<span id="L55" rel="#L55">55</span>
<span id="L56" rel="#L56">56</span>
<span id="L57" rel="#L57">57</span>
<span id="L58" rel="#L58">58</span>
<span id="L59" rel="#L59">59</span>
<span id="L60" rel="#L60">60</span>
<span id="L61" rel="#L61">61</span>
<span id="L62" rel="#L62">62</span>
<span id="L63" rel="#L63">63</span>
<span id="L64" rel="#L64">64</span>
<span id="L65" rel="#L65">65</span>
<span id="L66" rel="#L66">66</span>
<span id="L67" rel="#L67">67</span>
<span id="L68" rel="#L68">68</span>
<span id="L69" rel="#L69">69</span>
<span id="L70" rel="#L70">70</span>
<span id="L71" rel="#L71">71</span>
<span id="L72" rel="#L72">72</span>
<span id="L73" rel="#L73">73</span>
<span id="L74" rel="#L74">74</span>
<span id="L75" rel="#L75">75</span>
<span id="L76" rel="#L76">76</span>
<span id="L77" rel="#L77">77</span>
<span id="L78" rel="#L78">78</span>
<span id="L79" rel="#L79">79</span>
<span id="L80" rel="#L80">80</span>
<span id="L81" rel="#L81">81</span>
<span id="L82" rel="#L82">82</span>
<span id="L83" rel="#L83">83</span>
<span id="L84" rel="#L84">84</span>
<span id="L85" rel="#L85">85</span>
<span id="L86" rel="#L86">86</span>
<span id="L87" rel="#L87">87</span>
<span id="L88" rel="#L88">88</span>
<span id="L89" rel="#L89">89</span>
<span id="L90" rel="#L90">90</span>
<span id="L91" rel="#L91">91</span>
<span id="L92" rel="#L92">92</span>
<span id="L93" rel="#L93">93</span>
<span id="L94" rel="#L94">94</span>
<span id="L95" rel="#L95">95</span>
<span id="L96" rel="#L96">96</span>
<span id="L97" rel="#L97">97</span>
<span id="L98" rel="#L98">98</span>
<span id="L99" rel="#L99">99</span>
<span id="L100" rel="#L100">100</span>
<span id="L101" rel="#L101">101</span>
<span id="L102" rel="#L102">102</span>
<span id="L103" rel="#L103">103</span>
<span id="L104" rel="#L104">104</span>
<span id="L105" rel="#L105">105</span>
<span id="L106" rel="#L106">106</span>
<span id="L107" rel="#L107">107</span>
<span id="L108" rel="#L108">108</span>
<span id="L109" rel="#L109">109</span>

            </td>
            <td class="blob-line-code"><div class="code-body highlight"><pre><div class='line' id='LC1'><span class="cm">/* </span></div><div class='line' id='LC2'><span class="cm"> * Copyright (C) 2012 Jean-Philippe Auclair </span></div><div class='line' id='LC3'><span class="cm"> * Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php </span></div><div class='line' id='LC4'><span class="cm"> * Base64 library for ActionScript 3.0. </span></div><div class='line' id='LC5'><span class="cm"> * By: Jean-Philippe Auclair : http://jpauclair.net </span></div><div class='line' id='LC6'><span class="cm"> * Based on article: http://jpauclair.net/2010/01/09/base64-optimized-as3-lib/ </span></div><div class='line' id='LC7'><span class="cm"> * Benchmark: </span></div><div class='line' id='LC8'><span class="cm"> * This version: encode: 260ms decode: 255ms </span></div><div class='line' id='LC9'><span class="cm"> * Blog version: encode: 322ms decode: 694ms </span></div><div class='line' id='LC10'><span class="cm"> * as3Crypto encode: 6728ms decode: 4098ms </span></div><div class='line' id='LC11'><span class="cm"> * </span></div><div class='line' id='LC12'><span class="cm"> * Encode: com.sociodox.utils.Base64 is 25.8x faster than as3Crypto Base64 </span></div><div class='line' id='LC13'><span class="cm"> * Decode: com.sociodox.utils.Base64 is 16x faster than as3Crypto Base64 </span></div><div class='line' id='LC14'><span class="cm"> * </span></div><div class='line' id='LC15'><span class="cm"> * Optimize &amp; Profile any Flash content with TheMiner ( http://www.sociodox.com/theminer ) </span></div><div class='line' id='LC16'><span class="cm"> */</span></div><div class='line' id='LC17'><span class="k">package</span> <span class="nn">com.videojs</span> <span class="o">{</span></div><div class='line' id='LC18'><br/></div><div class='line' id='LC19'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">import</span> <span class="nn">flash.utils.ByteArray</span><span class="o">;</span></div><div class='line' id='LC20'><br/></div><div class='line' id='LC21'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="kd">public</span> <span class="kd">class</span> <span class="n">Base64</span> <span class="o">{</span></div><div class='line' id='LC22'><br/></div><div class='line' id='LC23'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// TEMP BASE64 FOR TESTING</span></div><div class='line' id='LC24'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// From: http://www.sociodox.com/base64.html</span></div><div class='line' id='LC25'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="kd">private</span> <span class="kd">static</span> <span class="kd">const</span> <span class="n">_decodeChars</span><span class="p">:</span><span class="kt">Vector.&lt;int&gt;</span> <span class="o">=</span> <span class="n">InitDecodeChar</span><span class="o">();</span></div><div class='line' id='LC26'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC27'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="kd">public</span> <span class="kd">static</span> <span class="kd">function </span><span class="nf">decode</span><span class="o">(</span><span class="n">str</span><span class="o">:</span><span class="kt">String</span><span class="o">):</span><span class="kt">ByteArray</span>  </div><div class='line' id='LC28'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">{</span>  </div><div class='line' id='LC29'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="kd">var</span> <span class="n">c1</span><span class="p">:</span><span class="kt">int</span><span class="o">;</span>  </div><div class='line' id='LC30'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="kd">var</span> <span class="n">c2</span><span class="p">:</span><span class="kt">int</span><span class="o">;</span>  </div><div class='line' id='LC31'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="kd">var</span> <span class="n">c3</span><span class="p">:</span><span class="kt">int</span><span class="o">;</span>  </div><div class='line' id='LC32'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="kd">var</span> <span class="n">c4</span><span class="p">:</span><span class="kt">int</span><span class="o">;</span>  </div><div class='line' id='LC33'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="kd">var</span> <span class="n">i</span><span class="p">:</span><span class="kt">int</span> <span class="o">=</span> <span class="mi">0</span><span class="o">;</span>  </div><div class='line' id='LC34'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="kd">var</span> <span class="n">len</span><span class="p">:</span><span class="kt">int</span> <span class="o">=</span> <span class="n">str</span><span class="o">.</span><span class="na">length</span><span class="o">;</span>  </div><div class='line' id='LC35'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC36'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="kd">var</span> <span class="n">byteString</span><span class="p">:</span><span class="kt">ByteArray</span> <span class="o">=</span> <span class="k">new</span> <span class="kt">ByteArray</span><span class="o">();</span>  </div><div class='line' id='LC37'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="n">byteString</span><span class="o">.</span><span class="na">writeUTFBytes</span><span class="o">(</span><span class="n">str</span><span class="o">);</span>  </div><div class='line' id='LC38'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="kd">var</span> <span class="n">outPos</span><span class="p">:</span><span class="kt">int</span> <span class="o">=</span> <span class="mi">0</span><span class="o">;</span>  </div><div class='line' id='LC39'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">while</span> <span class="o">(</span><span class="n">i</span> <span class="o">&lt;</span> <span class="n">len</span><span class="o">)</span>  </div><div class='line' id='LC40'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">{</span>  </div><div class='line' id='LC41'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">//c1  </span></div><div class='line' id='LC42'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="n">c1</span> <span class="o">=</span> <span class="n">_decodeChars</span><span class="o">[</span><span class="n">int</span><span class="o">(</span><span class="n">byteString</span><span class="o">[</span><span class="n">i</span><span class="o">++])];</span>  </div><div class='line' id='LC43'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="o">(</span><span class="n">c1</span> <span class="o">==</span> <span class="o">-</span><span class="mi">1</span><span class="o">)</span>  </div><div class='line' id='LC44'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">break</span><span class="o">;</span>  </div><div class='line' id='LC45'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC46'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">//c2  </span></div><div class='line' id='LC47'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="n">c2</span> <span class="o">=</span> <span class="n">_decodeChars</span><span class="o">[</span><span class="n">int</span><span class="o">(</span><span class="n">byteString</span><span class="o">[</span><span class="n">i</span><span class="o">++])];</span>  </div><div class='line' id='LC48'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="o">(</span><span class="n">c2</span> <span class="o">==</span> <span class="o">-</span><span class="mi">1</span><span class="o">)</span>  </div><div class='line' id='LC49'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">break</span><span class="o">;</span>  </div><div class='line' id='LC50'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC51'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="n">byteString</span><span class="o">[</span><span class="n">int</span><span class="o">(</span><span class="n">outPos</span><span class="o">++)]</span> <span class="o">=</span> <span class="o">(</span><span class="n">c1</span> <span class="o">&lt;&lt;</span> <span class="mi">2</span><span class="o">)</span> <span class="o">|</span> <span class="o">((</span><span class="n">c2</span> <span class="o">&amp;</span> <span class="mh">0x30</span><span class="o">)</span> <span class="o">&gt;&gt;</span> <span class="mi">4</span><span class="o">);</span>  </div><div class='line' id='LC52'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC53'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">//c3  </span></div><div class='line' id='LC54'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="n">c3</span> <span class="o">=</span> <span class="n">byteString</span><span class="o">[</span><span class="n">int</span><span class="o">(</span><span class="n">i</span><span class="o">++)];</span>  </div><div class='line' id='LC55'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="o">(</span><span class="n">c3</span> <span class="o">==</span> <span class="mi">61</span><span class="o">)</span>  </div><div class='line' id='LC56'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">{</span>  </div><div class='line' id='LC57'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="n">byteString</span><span class="o">.</span><span class="na">length</span> <span class="o">=</span> <span class="n">outPos</span>  </div><div class='line' id='LC58'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="n">byteString</span><span class="o">;</span>  </div><div class='line' id='LC59'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">}</span>  </div><div class='line' id='LC60'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC61'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="n">c3</span> <span class="o">=</span> <span class="n">_decodeChars</span><span class="o">[</span><span class="n">int</span><span class="o">(</span><span class="n">c3</span><span class="o">)];</span>  </div><div class='line' id='LC62'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="o">(</span><span class="n">c3</span> <span class="o">==</span> <span class="o">-</span><span class="mi">1</span><span class="o">)</span>  </div><div class='line' id='LC63'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">break</span><span class="o">;</span>  </div><div class='line' id='LC64'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC65'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="n">byteString</span><span class="o">[</span><span class="n">int</span><span class="o">(</span><span class="n">outPos</span><span class="o">++)]</span> <span class="o">=</span> <span class="o">((</span><span class="n">c2</span> <span class="o">&amp;</span> <span class="mh">0x0f</span><span class="o">)</span> <span class="o">&lt;&lt;</span> <span class="mi">4</span><span class="o">)</span> <span class="o">|</span> <span class="o">((</span><span class="n">c3</span> <span class="o">&amp;</span> <span class="mh">0x3c</span><span class="o">)</span> <span class="o">&gt;&gt;</span> <span class="mi">2</span><span class="o">);</span>  </div><div class='line' id='LC66'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC67'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">//c4  </span></div><div class='line' id='LC68'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="n">c4</span> <span class="o">=</span> <span class="n">byteString</span><span class="o">[</span><span class="n">int</span><span class="o">(</span><span class="n">i</span><span class="o">++)];</span>  </div><div class='line' id='LC69'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="o">(</span><span class="n">c4</span> <span class="o">==</span> <span class="mi">61</span><span class="o">)</span>  </div><div class='line' id='LC70'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">{</span>  </div><div class='line' id='LC71'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="n">byteString</span><span class="o">.</span><span class="na">length</span> <span class="o">=</span> <span class="n">outPos</span>  </div><div class='line' id='LC72'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="n">byteString</span><span class="o">;</span>  </div><div class='line' id='LC73'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">}</span>  </div><div class='line' id='LC74'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC75'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="n">c4</span> <span class="o">=</span> <span class="n">_decodeChars</span><span class="o">[</span><span class="n">int</span><span class="o">(</span><span class="n">c4</span><span class="o">)];</span>  </div><div class='line' id='LC76'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="o">(</span><span class="n">c4</span> <span class="o">==</span> <span class="o">-</span><span class="mi">1</span><span class="o">)</span>  </div><div class='line' id='LC77'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">break</span><span class="o">;</span>  </div><div class='line' id='LC78'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC79'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="n">byteString</span><span class="o">[</span><span class="n">int</span><span class="o">(</span><span class="n">outPos</span><span class="o">++)]</span> <span class="o">=</span> <span class="o">((</span><span class="n">c3</span> <span class="o">&amp;</span> <span class="mh">0x03</span><span class="o">)</span> <span class="o">&lt;&lt;</span> <span class="mi">6</span><span class="o">)</span> <span class="o">|</span> <span class="n">c4</span><span class="o">;</span>  </div><div class='line' id='LC80'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">}</span>  </div><div class='line' id='LC81'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="n">byteString</span><span class="o">.</span><span class="na">length</span> <span class="o">=</span> <span class="n">outPos</span>  </div><div class='line' id='LC82'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="n">byteString</span><span class="o">;</span>  </div><div class='line' id='LC83'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">}</span></div><div class='line' id='LC84'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC85'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="kd">public</span> <span class="kd">static</span> <span class="kd">function </span><span class="nf">InitDecodeChar</span><span class="o">():</span><span class="kt">Vector.&lt;int&gt;</span>  </div><div class='line' id='LC86'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">{</span>  </div><div class='line' id='LC87'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC88'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="kd">var</span> <span class="n">decodeChars</span><span class="p">:</span><span class="kt">Vector.&lt;int&gt;</span> <span class="o">=</span> <span class="k">new</span> <span class="o">&lt;</span><span class="n">int</span><span class="o">&gt;[</span>  </div><div class='line' id='LC89'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span>   </div><div class='line' id='LC90'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span>   </div><div class='line' id='LC91'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="mi">62</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="mi">63</span><span class="o">,</span>   </div><div class='line' id='LC92'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="mi">52</span><span class="o">,</span> <span class="mi">53</span><span class="o">,</span> <span class="mi">54</span><span class="o">,</span> <span class="mi">55</span><span class="o">,</span> <span class="mi">56</span><span class="o">,</span> <span class="mi">57</span><span class="o">,</span> <span class="mi">58</span><span class="o">,</span> <span class="mi">59</span><span class="o">,</span> <span class="mi">60</span><span class="o">,</span> <span class="mi">61</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span>   </div><div class='line' id='LC93'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">-</span><span class="mi">1</span><span class="o">,</span>  <span class="mi">0</span><span class="o">,</span>  <span class="mi">1</span><span class="o">,</span>  <span class="mi">2</span><span class="o">,</span>  <span class="mi">3</span><span class="o">,</span>  <span class="mi">4</span><span class="o">,</span>  <span class="mi">5</span><span class="o">,</span>  <span class="mi">6</span><span class="o">,</span>  <span class="mi">7</span><span class="o">,</span>  <span class="mi">8</span><span class="o">,</span>  <span class="mi">9</span><span class="o">,</span> <span class="mi">10</span><span class="o">,</span> <span class="mi">11</span><span class="o">,</span> <span class="mi">12</span><span class="o">,</span> <span class="mi">13</span><span class="o">,</span> <span class="mi">14</span><span class="o">,</span>   </div><div class='line' id='LC94'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="mi">15</span><span class="o">,</span> <span class="mi">16</span><span class="o">,</span> <span class="mi">17</span><span class="o">,</span> <span class="mi">18</span><span class="o">,</span> <span class="mi">19</span><span class="o">,</span> <span class="mi">20</span><span class="o">,</span> <span class="mi">21</span><span class="o">,</span> <span class="mi">22</span><span class="o">,</span> <span class="mi">23</span><span class="o">,</span> <span class="mi">24</span><span class="o">,</span> <span class="mi">25</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span>   </div><div class='line' id='LC95'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="mi">26</span><span class="o">,</span> <span class="mi">27</span><span class="o">,</span> <span class="mi">28</span><span class="o">,</span> <span class="mi">29</span><span class="o">,</span> <span class="mi">30</span><span class="o">,</span> <span class="mi">31</span><span class="o">,</span> <span class="mi">32</span><span class="o">,</span> <span class="mi">33</span><span class="o">,</span> <span class="mi">34</span><span class="o">,</span> <span class="mi">35</span><span class="o">,</span> <span class="mi">36</span><span class="o">,</span> <span class="mi">37</span><span class="o">,</span> <span class="mi">38</span><span class="o">,</span> <span class="mi">39</span><span class="o">,</span> <span class="mi">40</span><span class="o">,</span>   </div><div class='line' id='LC96'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="mi">41</span><span class="o">,</span> <span class="mi">42</span><span class="o">,</span> <span class="mi">43</span><span class="o">,</span> <span class="mi">44</span><span class="o">,</span> <span class="mi">45</span><span class="o">,</span> <span class="mi">46</span><span class="o">,</span> <span class="mi">47</span><span class="o">,</span> <span class="mi">48</span><span class="o">,</span> <span class="mi">49</span><span class="o">,</span> <span class="mi">50</span><span class="o">,</span> <span class="mi">51</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span>   </div><div class='line' id='LC97'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span>   </div><div class='line' id='LC98'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span>   </div><div class='line' id='LC99'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span>   </div><div class='line' id='LC100'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span>   </div><div class='line' id='LC101'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span>   </div><div class='line' id='LC102'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span>   </div><div class='line' id='LC103'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span>   </div><div class='line' id='LC104'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">,</span> <span class="o">-</span><span class="mi">1</span><span class="o">];</span>  </div><div class='line' id='LC105'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='line' id='LC106'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="n">decodeChars</span><span class="o">;</span>  </div><div class='line' id='LC107'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">}</span></div><div class='line' id='LC108'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">}</span></div><div class='line' id='LC109'><span class="o">}</span></div></pre></div></td>
          </tr>
        </table>
  </div>

  </div>
</div>

<a href="#jump-to-line" rel="facebox[.linejump]" data-hotkey="l" class="js-jump-to-line" style="display:none">Jump to Line</a>
<div id="jump-to-line" style="display:none">
  <form accept-charset="UTF-8" class="js-jump-to-line-form">
    <input class="linejump-input js-jump-to-line-field" type="text" placeholder="Jump to line&hellip;" autofocus>
    <button type="submit" class="button">Go</button>
  </form>
</div>

        </div>

      </div><!-- /.repo-container -->
      <div class="modal-backdrop"></div>
    </div><!-- /.container -->
  </div><!-- /.site -->


    </div><!-- /.wrapper -->

      <div class="container">
  <div class="site-footer">
    <ul class="site-footer-links right">
      <li><a href="https://status.github.com/">Status</a></li>
      <li><a href="http://developer.github.com">API</a></li>
      <li><a href="http://training.github.com">Training</a></li>
      <li><a href="http://shop.github.com">Shop</a></li>
      <li><a href="/blog">Blog</a></li>
      <li><a href="/about">About</a></li>

    </ul>

    <a href="/">
      <span class="mega-octicon octicon-mark-github" title="GitHub"></span>
    </a>

    <ul class="site-footer-links">
      <li>&copy; 2014 <span title="0.06095s from github-fe125-cp1-prd.iad.github.net">GitHub</span>, Inc.</li>
        <li><a href="/site/terms">Terms</a></li>
        <li><a href="/site/privacy">Privacy</a></li>
        <li><a href="/security">Security</a></li>
        <li><a href="/contact">Contact</a></li>
    </ul>
  </div><!-- /.site-footer -->
</div><!-- /.container -->


    <div class="fullscreen-overlay js-fullscreen-overlay" id="fullscreen_overlay">
  <div class="fullscreen-container js-fullscreen-container">
    <div class="textarea-wrap">
      <textarea name="fullscreen-contents" id="fullscreen-contents" class="js-fullscreen-contents" placeholder="" data-suggester="fullscreen_suggester"></textarea>
    </div>
  </div>
  <div class="fullscreen-sidebar">
    <a href="#" class="exit-fullscreen js-exit-fullscreen tooltipped tooltipped-w" aria-label="Exit Zen Mode">
      <span class="mega-octicon octicon-screen-normal"></span>
    </a>
    <a href="#" class="theme-switcher js-theme-switcher tooltipped tooltipped-w"
      aria-label="Switch themes">
      <span class="octicon octicon-color-mode"></span>
    </a>
  </div>
</div>



    <div id="ajax-error-message" class="flash flash-error">
      <span class="octicon octicon-alert"></span>
      <a href="#" class="octicon octicon-remove-close close js-ajax-error-dismiss"></a>
      Something went wrong with that request. Please try again.
    </div>

  </body>
</html>

