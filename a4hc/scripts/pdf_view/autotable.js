





<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">



  <link crossorigin="anonymous" href="https://assets-cdn.github.com/assets/frameworks-148da7a2b8b9ad739a5a0b8b68683fed4ac7e50ce8185f17d86aa05e75ed376e.css" integrity="sha256-FI2nori5rXOaWguLaGg/7UrH5QzoGF8X2GqgXnXtN24=" media="all" rel="stylesheet" />
  <link crossorigin="anonymous" href="https://assets-cdn.github.com/assets/github-4cb6b37ae0c653978a80cfe0c9288fcb02f00f746d1e076237703e57761c8973.css" integrity="sha256-TLazeuDGU5eKgM/gySiPywLwD3RtHgdiN3A+V3YciXM=" media="all" rel="stylesheet" />
  
  
  <link crossorigin="anonymous" href="https://assets-cdn.github.com/assets/site-533b8a15e9857d8168369b00b52ff589cba2fe9e3ecf8db1a110517b9814d246.css" integrity="sha256-UzuKFemFfYFoNpsAtS/1icui/p4+z42xoRBRe5gU0kY=" media="all" rel="stylesheet" />
  

  <meta name="viewport" content="width=device-width">
  
  <title>jsPDF-AutoTable/jspdf.plugin.autotable.min.js at master · simonbengtsson/jsPDF-AutoTable · GitHub</title>
  <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="GitHub">
  <link rel="fluid-icon" href="https://github.com/fluidicon.png" title="GitHub">
  <meta property="fb:app_id" content="1401488693436528">

    
    <meta content="https://avatars0.githubusercontent.com/u/3586691?v=3&amp;s=400" property="og:image" /><meta content="GitHub" property="og:site_name" /><meta content="object" property="og:type" /><meta content="simonbengtsson/jsPDF-AutoTable" property="og:title" /><meta content="https://github.com/simonbengtsson/jsPDF-AutoTable" property="og:url" /><meta content="jsPDF-AutoTable - jsPDF plugin for generating PDF tables with javascript" property="og:description" />

  <link rel="assets" href="https://assets-cdn.github.com/">
  
  <meta name="pjax-timeout" content="1000">
  
  <meta name="request-id" content="E427:5AB4:3A94999:56BFF9A:592BB680" data-pjax-transient>
  

  <meta name="selected-link" value="repo_source" data-pjax-transient>

  <meta name="google-site-verification" content="KT5gs8h0wvaagLKAVWq8bbeNwnZZK1r1XQysX3xurLU">
<meta name="google-site-verification" content="ZzhVyEFwb7w3e0-uOTltm8Jsck2F5StVihD0exw2fsA">
    <meta name="google-analytics" content="UA-3769691-2">

<meta content="collector.githubapp.com" name="octolytics-host" /><meta content="github" name="octolytics-app-id" /><meta content="https://collector.githubapp.com/github-external/browser_event" name="octolytics-event-url" /><meta content="E427:5AB4:3A94999:56BFF9A:592BB680" name="octolytics-dimension-request_id" /><meta content="iad" name="octolytics-dimension-region_edge" /><meta content="iad" name="octolytics-dimension-region_render" />
<meta content="/&lt;user-name&gt;/&lt;repo-name&gt;/blob/show" data-pjax-transient="true" name="analytics-location" />




  <meta class="js-ga-set" name="dimension1" content="Logged Out">


  

      <meta name="hostname" content="github.com">
  <meta name="user-login" content="">

      <meta name="expected-hostname" content="github.com">
    <meta name="js-proxy-site-detection-payload" content="Zjg4OWIwMzlhZmIzNjE2YzMzZmI1NDgwZTllZjUwZmZhOTdkNGU3MTU0ZDc4MmYwNzY0Y2U1MTFkNDQyOTFjMXx7InJlbW90ZV9hZGRyZXNzIjoiMTA4LjE4MS4yOC4yMDEiLCJyZXF1ZXN0X2lkIjoiRTQyNzo1QUI0OjNBOTQ5OTk6NTZCRkY5QTo1OTJCQjY4MCIsInRpbWVzdGFtcCI6MTQ5NjAzNjk5NiwiaG9zdCI6ImdpdGh1Yi5jb20ifQ==">


  <meta name="html-safe-nonce" content="d2de888b0890a0ca4a6a28b7b3ff0ca08830ebc7">

  <meta http-equiv="x-pjax-version" content="757efe3f0bbc93dc131b9a7d2ae5448c">
  

    
  <meta name="description" content="jsPDF-AutoTable - jsPDF plugin for generating PDF tables with javascript">
  <meta name="go-import" content="github.com/simonbengtsson/jsPDF-AutoTable git https://github.com/simonbengtsson/jsPDF-AutoTable.git">

  <meta content="3586691" name="octolytics-dimension-user_id" /><meta content="simonbengtsson" name="octolytics-dimension-user_login" /><meta content="23654633" name="octolytics-dimension-repository_id" /><meta content="simonbengtsson/jsPDF-AutoTable" name="octolytics-dimension-repository_nwo" /><meta content="true" name="octolytics-dimension-repository_public" /><meta content="false" name="octolytics-dimension-repository_is_fork" /><meta content="23654633" name="octolytics-dimension-repository_network_root_id" /><meta content="simonbengtsson/jsPDF-AutoTable" name="octolytics-dimension-repository_network_root_nwo" />
  <link href="https://github.com/simonbengtsson/jsPDF-AutoTable/commits/master.atom" rel="alternate" title="Recent Commits to jsPDF-AutoTable:master" type="application/atom+xml">


    <link rel="canonical" href="https://github.com/simonbengtsson/jsPDF-AutoTable/blob/master/dist/jspdf.plugin.autotable.min.js" data-pjax-transient>


  <meta name="browser-stats-url" content="https://api.github.com/_private/browser/stats">

  <meta name="browser-errors-url" content="https://api.github.com/_private/browser/errors">

  <link rel="mask-icon" href="https://assets-cdn.github.com/pinned-octocat.svg" color="#000000">
  <link rel="icon" type="image/x-icon" href="https://assets-cdn.github.com/favicon.ico">

<meta name="theme-color" content="#1e2327">


  <meta name="u2f-support" content="true">

  </head>

  <body class="logged-out env-production page-blob">
    



  <div class="position-relative js-header-wrapper ">
    <a href="#start-of-content" tabindex="1" class="accessibility-aid js-skip-to-content">Skip to content</a>
    <div id="js-pjax-loader-bar" class="pjax-loader-bar"><div class="progress"></div></div>

    
    
    



          <header class="site-header js-details-container Details" role="banner">
  <div class="site-nav-container">
    <a class="header-logo-invertocat" href="https://github.com/" aria-label="Homepage" data-ga-click="(Logged out) Header, go to homepage, icon:logo-wordmark">
      <svg aria-hidden="true" class="octicon octicon-mark-github" height="32" version="1.1" viewBox="0 0 16 16" width="32"><path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>
    </a>

    <button class="btn-link float-right site-header-toggle js-details-target" type="button" aria-label="Toggle navigation">
      <svg aria-hidden="true" class="octicon octicon-three-bars" height="24" version="1.1" viewBox="0 0 12 16" width="18"><path fill-rule="evenodd" d="M11.41 9H.59C0 9 0 8.59 0 8c0-.59 0-1 .59-1H11.4c.59 0 .59.41.59 1 0 .59 0 1-.59 1h.01zm0-4H.59C0 5 0 4.59 0 4c0-.59 0-1 .59-1H11.4c.59 0 .59.41.59 1 0 .59 0 1-.59 1h.01zM.59 11H11.4c.59 0 .59.41.59 1 0 .59 0 1-.59 1H.59C0 13 0 12.59 0 12c0-.59 0-1 .59-1z"/></svg>
    </button>

    <div class="site-header-menu">
      <nav class="site-header-nav">
        <a href="/features" class="js-selected-navigation-item nav-item" data-ga-click="Header, click, Nav menu - item:features" data-selected-links="/features /features">
          Features
</a>        <a href="/business" class="js-selected-navigation-item nav-item" data-ga-click="Header, click, Nav menu - item:business" data-selected-links="/business /business/security /business/customers /business">
          Business
</a>        <a href="/explore" class="js-selected-navigation-item nav-item" data-ga-click="Header, click, Nav menu - item:explore" data-selected-links="/explore /trending /trending/developers /integrations /integrations/feature/code /integrations/feature/collaborate /integrations/feature/ship /showcases /explore">
          Explore
</a>            <a href="/marketplace" class="js-selected-navigation-item nav-item" data-ga-click="Header, click, Nav menu - item:marketplace" data-selected-links=" /marketplace">
              Marketplace
</a>        <a href="/pricing" class="js-selected-navigation-item nav-item" data-ga-click="Header, click, Nav menu - item:pricing" data-selected-links="/pricing /pricing/developer /pricing/team /pricing/business-hosted /pricing/business-enterprise /pricing">
          Pricing
</a>      </nav>

      <div class="site-header-actions">
          <div class="header-search scoped-search site-scoped-search js-site-search" role="search">
  <!-- '"` --><!-- </textarea></xmp> --></option></form><form accept-charset="UTF-8" action="/simonbengtsson/jsPDF-AutoTable/search" class="js-site-search-form" data-scoped-search-url="/simonbengtsson/jsPDF-AutoTable/search" data-unscoped-search-url="/search" method="get"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /></div>
    <label class="form-control header-search-wrapper js-chromeless-input-container">
        <a href="/simonbengtsson/jsPDF-AutoTable/blob/master/dist/jspdf.plugin.autotable.min.js" class="header-search-scope no-underline">This repository</a>
      <input type="text"
        class="form-control header-search-input js-site-search-focus js-site-search-field is-clearable"
        data-hotkey="s"
        name="q"
        value=""
        placeholder="Search"
        aria-label="Search this repository"
        data-unscoped-placeholder="Search GitHub"
        data-scoped-placeholder="Search"
        autocapitalize="off">
        <input type="hidden" class="js-site-search-type-field" name="type" >
    </label>
</form></div>


          <a class="text-bold site-header-link" href="/login?return_to=%2Fsimonbengtsson%2FjsPDF-AutoTable%2Fblob%2Fmaster%2Fdist%2Fjspdf.plugin.autotable.min.js" data-ga-click="(Logged out) Header, clicked Sign in, text:sign-in">Sign in</a>
            <span class="text-gray">or</span>
            <a class="text-bold site-header-link" href="/join?source=header-repo" data-ga-click="(Logged out) Header, clicked Sign up, text:sign-up">Sign up</a>
      </div>
    </div>
  </div>
</header>


  </div>

  <div id="start-of-content" class="accessibility-aid"></div>

    <div id="js-flash-container">
</div>



  <div role="main">
        <div itemscope itemtype="http://schema.org/SoftwareSourceCode">
    <div id="js-repo-pjax-container" data-pjax-container>
        



    <div class="pagehead repohead instapaper_ignore readability-menu experiment-repo-nav">
      <div class="container repohead-details-container">

        <ul class="pagehead-actions">
  <li>
      <a href="/login?return_to=%2Fsimonbengtsson%2FjsPDF-AutoTable"
    class="btn btn-sm btn-with-count tooltipped tooltipped-n"
    aria-label="You must be signed in to watch a repository" rel="nofollow">
    <svg aria-hidden="true" class="octicon octicon-eye" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path fill-rule="evenodd" d="M8.06 2C3 2 0 8 0 8s3 6 8.06 6C13 14 16 8 16 8s-3-6-7.94-6zM8 12c-2.2 0-4-1.78-4-4 0-2.2 1.8-4 4-4 2.22 0 4 1.8 4 4 0 2.22-1.78 4-4 4zm2-4c0 1.11-.89 2-2 2-1.11 0-2-.89-2-2 0-1.11.89-2 2-2 1.11 0 2 .89 2 2z"/></svg>
    Watch
  </a>
  <a class="social-count" href="/simonbengtsson/jsPDF-AutoTable/watchers"
     aria-label="25 users are watching this repository">
    25
  </a>

  </li>

  <li>
      <a href="/login?return_to=%2Fsimonbengtsson%2FjsPDF-AutoTable"
    class="btn btn-sm btn-with-count tooltipped tooltipped-n"
    aria-label="You must be signed in to star a repository" rel="nofollow">
    <svg aria-hidden="true" class="octicon octicon-star" height="16" version="1.1" viewBox="0 0 14 16" width="14"><path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74z"/></svg>
    Star
  </a>

    <a class="social-count js-social-count" href="/simonbengtsson/jsPDF-AutoTable/stargazers"
      aria-label="373 users starred this repository">
      373
    </a>

  </li>

  <li>
      <a href="/login?return_to=%2Fsimonbengtsson%2FjsPDF-AutoTable"
        class="btn btn-sm btn-with-count tooltipped tooltipped-n"
        aria-label="You must be signed in to fork a repository" rel="nofollow">
        <svg aria-hidden="true" class="octicon octicon-repo-forked" height="16" version="1.1" viewBox="0 0 10 16" width="10"><path fill-rule="evenodd" d="M8 1a1.993 1.993 0 0 0-1 3.72V6L5 8 3 6V4.72A1.993 1.993 0 0 0 2 1a1.993 1.993 0 0 0-1 3.72V6.5l3 3v1.78A1.993 1.993 0 0 0 5 15a1.993 1.993 0 0 0 1-3.72V9.5l3-3V4.72A1.993 1.993 0 0 0 8 1zM2 4.2C1.34 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3 10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3-10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"/></svg>
        Fork
      </a>

    <a href="/simonbengtsson/jsPDF-AutoTable/network" class="social-count"
       aria-label="124 users forked this repository">
      124
    </a>
  </li>
</ul>

        <h1 class="public ">
  <svg aria-hidden="true" class="octicon octicon-repo" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M4 9H3V8h1v1zm0-3H3v1h1V6zm0-2H3v1h1V4zm0-2H3v1h1V2zm8-1v12c0 .55-.45 1-1 1H6v2l-1.5-1.5L3 16v-2H1c-.55 0-1-.45-1-1V1c0-.55.45-1 1-1h10c.55 0 1 .45 1 1zm-1 10H1v2h2v-1h3v1h5v-2zm0-10H2v9h9V1z"/></svg>
  <span class="author" itemprop="author"><a href="/simonbengtsson" class="url fn" rel="author">simonbengtsson</a></span><!--
--><span class="path-divider">/</span><!--
--><strong itemprop="name"><a href="/simonbengtsson/jsPDF-AutoTable" data-pjax="#js-repo-pjax-container">jsPDF-AutoTable</a></strong>

</h1>

      </div>
      <div class="container">
        
<nav class="reponav js-repo-nav js-sidenav-container-pjax"
     itemscope
     itemtype="http://schema.org/BreadcrumbList"
     role="navigation"
     data-pjax="#js-repo-pjax-container">

  <span itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
    <a href="/simonbengtsson/jsPDF-AutoTable" class="js-selected-navigation-item selected reponav-item" data-hotkey="g c" data-selected-links="repo_source repo_downloads repo_commits repo_releases repo_tags repo_branches /simonbengtsson/jsPDF-AutoTable" itemprop="url">
      <svg aria-hidden="true" class="octicon octicon-code" height="16" version="1.1" viewBox="0 0 14 16" width="14"><path fill-rule="evenodd" d="M9.5 3L8 4.5 11.5 8 8 11.5 9.5 13 14 8 9.5 3zm-5 0L0 8l4.5 5L6 11.5 2.5 8 6 4.5 4.5 3z"/></svg>
      <span itemprop="name">Code</span>
      <meta itemprop="position" content="1">
</a>  </span>

    <span itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
      <a href="/simonbengtsson/jsPDF-AutoTable/issues" class="js-selected-navigation-item reponav-item" data-hotkey="g i" data-selected-links="repo_issues repo_labels repo_milestones /simonbengtsson/jsPDF-AutoTable/issues" itemprop="url">
        <svg aria-hidden="true" class="octicon octicon-issue-opened" height="16" version="1.1" viewBox="0 0 14 16" width="14"><path fill-rule="evenodd" d="M7 2.3c3.14 0 5.7 2.56 5.7 5.7s-2.56 5.7-5.7 5.7A5.71 5.71 0 0 1 1.3 8c0-3.14 2.56-5.7 5.7-5.7zM7 1C3.14 1 0 4.14 0 8s3.14 7 7 7 7-3.14 7-7-3.14-7-7-7zm1 3H6v5h2V4zm0 6H6v2h2v-2z"/></svg>
        <span itemprop="name">Issues</span>
        <span class="Counter">9</span>
        <meta itemprop="position" content="2">
</a>    </span>

  <span itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
    <a href="/simonbengtsson/jsPDF-AutoTable/pulls" class="js-selected-navigation-item reponav-item" data-hotkey="g p" data-selected-links="repo_pulls /simonbengtsson/jsPDF-AutoTable/pulls" itemprop="url">
      <svg aria-hidden="true" class="octicon octicon-git-pull-request" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M11 11.28V5c-.03-.78-.34-1.47-.94-2.06C9.46 2.35 8.78 2.03 8 2H7V0L4 3l3 3V4h1c.27.02.48.11.69.31.21.2.3.42.31.69v6.28A1.993 1.993 0 0 0 10 15a1.993 1.993 0 0 0 1-3.72zm-1 2.92c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zM4 3c0-1.11-.89-2-2-2a1.993 1.993 0 0 0-1 3.72v6.56A1.993 1.993 0 0 0 2 15a1.993 1.993 0 0 0 1-3.72V4.72c.59-.34 1-.98 1-1.72zm-.8 10c0 .66-.55 1.2-1.2 1.2-.65 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2zM2 4.2C1.34 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"/></svg>
      <span itemprop="name">Pull requests</span>
      <span class="Counter">0</span>
      <meta itemprop="position" content="3">
</a>  </span>

    <a href="/simonbengtsson/jsPDF-AutoTable/projects" class="js-selected-navigation-item reponav-item" data-selected-links="repo_projects new_repo_project repo_project /simonbengtsson/jsPDF-AutoTable/projects">
      <svg aria-hidden="true" class="octicon octicon-project" height="16" version="1.1" viewBox="0 0 15 16" width="15"><path fill-rule="evenodd" d="M10 12h3V2h-3v10zm-4-2h3V2H6v8zm-4 4h3V2H2v12zm-1 1h13V1H1v14zM14 0H1a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h13a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1z"/></svg>
      Projects
      <span class="Counter" >1</span>
</a>
    <a href="/simonbengtsson/jsPDF-AutoTable/wiki" class="js-selected-navigation-item reponav-item" data-hotkey="g w" data-selected-links="repo_wiki /simonbengtsson/jsPDF-AutoTable/wiki">
      <svg aria-hidden="true" class="octicon octicon-book" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path fill-rule="evenodd" d="M3 5h4v1H3V5zm0 3h4V7H3v1zm0 2h4V9H3v1zm11-5h-4v1h4V5zm0 2h-4v1h4V7zm0 2h-4v1h4V9zm2-6v9c0 .55-.45 1-1 1H9.5l-1 1-1-1H2c-.55 0-1-.45-1-1V3c0-.55.45-1 1-1h5.5l1 1 1-1H15c.55 0 1 .45 1 1zm-8 .5L7.5 3H2v9h6V3.5zm7-.5H9.5l-.5.5V12h6V3z"/></svg>
      Wiki
</a>

    <div class="reponav-dropdown js-menu-container">
      <button type="button" class="btn-link reponav-item reponav-dropdown js-menu-target " data-no-toggle aria-expanded="false" aria-haspopup="true">
        Insights
        <svg aria-hidden="true" class="octicon octicon-triangle-down v-align-middle text-gray" height="11" version="1.1" viewBox="0 0 12 16" width="8"><path fill-rule="evenodd" d="M0 5l6 6 6-6z"/></svg>
      </button>
      <div class="dropdown-menu-content js-menu-content">
        <div class="dropdown-menu dropdown-menu-sw">
          <a class="dropdown-item" href="/simonbengtsson/jsPDF-AutoTable/pulse" data-skip-pjax>
            <svg aria-hidden="true" class="octicon octicon-pulse" height="16" version="1.1" viewBox="0 0 14 16" width="14"><path fill-rule="evenodd" d="M11.5 8L8.8 5.4 6.6 8.5 5.5 1.6 2.38 8H0v2h3.6l.9-1.8.9 5.4L9 8.5l1.6 1.5H14V8z"/></svg>
            Pulse
          </a>
          <a class="dropdown-item" href="/simonbengtsson/jsPDF-AutoTable/graphs" data-skip-pjax>
            <svg aria-hidden="true" class="octicon octicon-graph" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path fill-rule="evenodd" d="M16 14v1H0V0h1v14h15zM5 13H3V8h2v5zm4 0H7V3h2v10zm4 0h-2V6h2v7z"/></svg>
            Graphs
          </a>
        </div>
      </div>
    </div>
</nav>

      </div>
    </div>

<div class="container new-discussion-timeline experiment-repo-nav">
  <div class="repository-content">

    
          

<a href="/simonbengtsson/jsPDF-AutoTable/blob/409ae6a0f6b21af849ff950e8404dc795c3153e1/dist/jspdf.plugin.autotable.min.js" class="d-none js-permalink-shortcut" data-hotkey="y">Permalink</a>

<!-- blob contrib key: blob_contributors:v21:d5100696ed9df0cd204a0092d3e5d1b6 -->

<div class="file-navigation js-zeroclipboard-container">
  
<div class="select-menu branch-select-menu js-menu-container js-select-menu float-left">
  <button class=" btn btn-sm select-menu-button js-menu-target css-truncate" data-hotkey="w"
    
    type="button" aria-label="Switch branches or tags" tabindex="0" aria-haspopup="true">
      <i>Branch:</i>
      <span class="js-select-button css-truncate-target">master</span>
  </button>

  <div class="select-menu-modal-holder js-menu-content js-navigation-container" data-pjax>

    <div class="select-menu-modal">
      <div class="select-menu-header">
        <svg aria-label="Close" class="octicon octicon-x js-menu-close" height="16" role="img" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48z"/></svg>
        <span class="select-menu-title">Switch branches/tags</span>
      </div>

      <div class="select-menu-filters">
        <div class="select-menu-text-filter">
          <input type="text" aria-label="Filter branches/tags" id="context-commitish-filter-field" class="form-control js-filterable-field js-navigation-enable" placeholder="Filter branches/tags">
        </div>
        <div class="select-menu-tabs">
          <ul>
            <li class="select-menu-tab">
              <a href="#" data-tab-filter="branches" data-filter-placeholder="Filter branches/tags" class="js-select-menu-tab" role="tab">Branches</a>
            </li>
            <li class="select-menu-tab">
              <a href="#" data-tab-filter="tags" data-filter-placeholder="Find a tag…" class="js-select-menu-tab" role="tab">Tags</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket" data-tab-filter="branches" role="menu">

        <div data-filterable-for="context-commitish-filter-field" data-filterable-type="substring">


            <a class="select-menu-item js-navigation-item js-navigation-open "
               href="/simonbengtsson/jsPDF-AutoTable/blob/gh-pages/dist/jspdf.plugin.autotable.min.js"
               data-name="gh-pages"
               data-skip-pjax="true"
               rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target js-select-menu-filter-text">
                gh-pages
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
               href="/simonbengtsson/jsPDF-AutoTable/blob/hotfix-multi-page-horizontal-tables/dist/jspdf.plugin.autotable.min.js"
               data-name="hotfix-multi-page-horizontal-tables"
               data-skip-pjax="true"
               rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target js-select-menu-filter-text">
                hotfix-multi-page-horizontal-tables
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open selected"
               href="/simonbengtsson/jsPDF-AutoTable/blob/master/dist/jspdf.plugin.autotable.min.js"
               data-name="master"
               data-skip-pjax="true"
               rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target js-select-menu-filter-text">
                master
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
               href="/simonbengtsson/jsPDF-AutoTable/blob/revert-175-addPage_hook/dist/jspdf.plugin.autotable.min.js"
               data-name="revert-175-addPage_hook"
               data-skip-pjax="true"
               rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target js-select-menu-filter-text">
                revert-175-addPage_hook
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
               href="/simonbengtsson/jsPDF-AutoTable/blob/v3/dist/jspdf.plugin.autotable.min.js"
               data-name="v3"
               data-skip-pjax="true"
               rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target js-select-menu-filter-text">
                v3
              </span>
            </a>
        </div>

          <div class="select-menu-no-results">Nothing to show</div>
      </div>

      <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket" data-tab-filter="tags">
        <div data-filterable-for="context-commitish-filter-field" data-filterable-type="substring">


            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.3.2/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.3.2"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.3.2">
                v2.3.2
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.3.1/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.3.1"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.3.1">
                v2.3.1
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.3.0/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.3.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.3.0">
                v2.3.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.2.3/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.2.3"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.2.3">
                v2.2.3
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.2.2/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.2.2"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.2.2">
                v2.2.2
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.2.0/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.2.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.2.0">
                v2.2.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.1.0/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.1.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.1.0">
                v2.1.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.37/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.37"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.37">
                v2.0.37
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.36/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.36"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.36">
                v2.0.36
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.35/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.35"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.35">
                v2.0.35
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.34/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.34"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.34">
                v2.0.34
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.33/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.33"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.33">
                v2.0.33
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.32/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.32"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.32">
                v2.0.32
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.31/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.31"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.31">
                v2.0.31
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.30/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.30"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.30">
                v2.0.30
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.29/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.29"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.29">
                v2.0.29
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.28/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.28"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.28">
                v2.0.28
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.27/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.27"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.27">
                v2.0.27
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.26/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.26"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.26">
                v2.0.26
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.25/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.25"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.25">
                v2.0.25
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.24/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.24"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.24">
                v2.0.24
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.23/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.23"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.23">
                v2.0.23
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.22/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.22"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.22">
                v2.0.22
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.21/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.21"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.21">
                v2.0.21
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.20/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.20"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.20">
                v2.0.20
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.19/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.19"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.19">
                v2.0.19
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.18/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.18"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.18">
                v2.0.18
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.17/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.17"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.17">
                v2.0.17
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.16/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.16"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.16">
                v2.0.16
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.15/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.15"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.15">
                v2.0.15
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.14/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.14"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.14">
                v2.0.14
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.13/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.13"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.13">
                v2.0.13
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.12/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.12"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.12">
                v2.0.12
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.11/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.11"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.11">
                v2.0.11
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.10/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.10"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.10">
                v2.0.10
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.9/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.9"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.9">
                v2.0.9
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.8/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.8"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.8">
                v2.0.8
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.7/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.7"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.7">
                v2.0.7
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.6/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.6"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.6">
                v2.0.6
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.5/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.5"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.5">
                v2.0.5
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.4/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.4"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.4">
                v2.0.4
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v2.0.3/dist/jspdf.plugin.autotable.min.js"
              data-name="v2.0.3"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v2.0.3">
                v2.0.3
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/v1.2.3/dist/jspdf.plugin.autotable.min.js"
              data-name="v1.2.3"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v1.2.3">
                v1.2.3
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/2.0.2/dist/jspdf.plugin.autotable.min.js"
              data-name="2.0.2"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="2.0.2">
                2.0.2
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/2.0.1/dist/jspdf.plugin.autotable.min.js"
              data-name="2.0.1"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="2.0.1">
                2.0.1
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/2.0.0/dist/jspdf.plugin.autotable.min.js"
              data-name="2.0.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="2.0.0">
                2.0.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/1.3.4/dist/jspdf.plugin.autotable.min.js"
              data-name="1.3.4"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="1.3.4">
                1.3.4
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/1.3.3/dist/jspdf.plugin.autotable.min.js"
              data-name="1.3.3"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="1.3.3">
                1.3.3
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/1.3.2/dist/jspdf.plugin.autotable.min.js"
              data-name="1.3.2"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="1.3.2">
                1.3.2
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/1.3.1/dist/jspdf.plugin.autotable.min.js"
              data-name="1.3.1"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="1.3.1">
                1.3.1
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/1.3.0/dist/jspdf.plugin.autotable.min.js"
              data-name="1.3.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="1.3.0">
                1.3.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/1.2.4/dist/jspdf.plugin.autotable.min.js"
              data-name="1.2.4"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="1.2.4">
                1.2.4
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/1.2.2/dist/jspdf.plugin.autotable.min.js"
              data-name="1.2.2"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="1.2.2">
                1.2.2
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/1.2.1/dist/jspdf.plugin.autotable.min.js"
              data-name="1.2.1"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="1.2.1">
                1.2.1
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/1.2.0/dist/jspdf.plugin.autotable.min.js"
              data-name="1.2.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="1.2.0">
                1.2.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/1.1.1/dist/jspdf.plugin.autotable.min.js"
              data-name="1.1.1"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="1.1.1">
                1.1.1
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/1.1.0/dist/jspdf.plugin.autotable.min.js"
              data-name="1.1.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="1.1.0">
                1.1.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/1.0.1/dist/jspdf.plugin.autotable.min.js"
              data-name="1.0.1"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="1.0.1">
                1.0.1
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/1.0.0/dist/jspdf.plugin.autotable.min.js"
              data-name="1.0.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="1.0.0">
                1.0.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/0.0.3/dist/jspdf.plugin.autotable.min.js"
              data-name="0.0.3"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="0.0.3">
                0.0.3
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/0.0.2/dist/jspdf.plugin.autotable.min.js"
              data-name="0.0.2"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="0.0.2">
                0.0.2
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/simonbengtsson/jsPDF-AutoTable/tree/0.0.1/dist/jspdf.plugin.autotable.min.js"
              data-name="0.0.1"
              data-skip-pjax="true"
              rel="nofollow">
              <svg aria-hidden="true" class="octicon octicon-check select-menu-item-icon" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="0.0.1">
                0.0.1
              </span>
            </a>
        </div>

        <div class="select-menu-no-results">Nothing to show</div>
      </div>

    </div>
  </div>
</div>

  <div class="BtnGroup float-right">
    <a href="/simonbengtsson/jsPDF-AutoTable/find/master"
          class="js-pjax-capture-input btn btn-sm BtnGroup-item"
          data-pjax
          data-hotkey="t">
      Find file
    </a>
    <button aria-label="Copy file path to clipboard" class="js-zeroclipboard btn btn-sm BtnGroup-item tooltipped tooltipped-s" data-copied-hint="Copied!" type="button">Copy path</button>
  </div>
  <div class="breadcrumb js-zeroclipboard-target">
    <span class="repo-root js-repo-root"><span class="js-path-segment"><a href="/simonbengtsson/jsPDF-AutoTable"><span>jsPDF-AutoTable</span></a></span></span><span class="separator">/</span><span class="js-path-segment"><a href="/simonbengtsson/jsPDF-AutoTable/tree/master/dist"><span>dist</span></a></span><span class="separator">/</span><strong class="final-path">jspdf.plugin.autotable.min.js</strong>
  </div>
</div>



  <div class="commit-tease">
      <span class="float-right">
        <a class="commit-tease-sha" href="/simonbengtsson/jsPDF-AutoTable/commit/409ae6a0f6b21af849ff950e8404dc795c3153e1" data-pjax>
          409ae6a
        </a>
        <relative-time datetime="2017-05-23T13:37:55Z">May 23, 2017</relative-time>
      </span>
      <div>
        <img alt="@simonbengtsson" class="avatar" height="20" src="https://avatars2.githubusercontent.com/u/3586691?v=3&amp;s=40" width="20" />
        <a href="/simonbengtsson" class="user-mention" rel="author">simonbengtsson</a>
          <a href="/simonbengtsson/jsPDF-AutoTable/commit/409ae6a0f6b21af849ff950e8404dc795c3153e1" class="message" data-pjax="true" title="2.3.2">2.3.2</a>
      </div>

    <div class="commit-tease-contributors">
      <button type="button" class="btn-link muted-link contributors-toggle" data-facebox="#blob_contributors_box">
        <strong>1</strong>
         contributor
      </button>
      
    </div>

    <div id="blob_contributors_box" style="display:none">
      <h2 class="facebox-header" data-facebox-id="facebox-header">Users who have contributed to this file</h2>
      <ul class="facebox-user-list" data-facebox-id="facebox-description">
          <li class="facebox-user-list-item">
            <img alt="@simonbengtsson" height="24" src="https://avatars0.githubusercontent.com/u/3586691?v=3&amp;s=48" width="24" />
            <a href="/simonbengtsson">simonbengtsson</a>
          </li>
      </ul>
    </div>
  </div>

<div class="file">
  <div class="file-header">
  <div class="file-actions">

    <div class="BtnGroup">
      <a href="/simonbengtsson/jsPDF-AutoTable/raw/master/dist/jspdf.plugin.autotable.min.js" class="btn btn-sm BtnGroup-item" id="raw-url">Raw</a>
        <a href="/simonbengtsson/jsPDF-AutoTable/blame/master/dist/jspdf.plugin.autotable.min.js" class="btn btn-sm js-update-url-with-hash BtnGroup-item" data-hotkey="b">Blame</a>
      <a href="/simonbengtsson/jsPDF-AutoTable/commits/master/dist/jspdf.plugin.autotable.min.js" class="btn btn-sm BtnGroup-item" rel="nofollow">History</a>
    </div>

        <a class="btn-octicon tooltipped tooltipped-nw"
           href="https://desktop.github.com"
           aria-label="Open this file in GitHub Desktop"
           data-ga-click="Repository, open with desktop, type:windows">
            <svg aria-hidden="true" class="octicon octicon-device-desktop" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path fill-rule="evenodd" d="M15 2H1c-.55 0-1 .45-1 1v9c0 .55.45 1 1 1h5.34c-.25.61-.86 1.39-2.34 2h8c-1.48-.61-2.09-1.39-2.34-2H15c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1zm0 9H1V3h14v8z"/></svg>
        </a>

        <button type="button" class="btn-octicon disabled tooltipped tooltipped-nw"
          aria-label="You must be signed in to make or propose changes">
          <svg aria-hidden="true" class="octicon octicon-pencil" height="16" version="1.1" viewBox="0 0 14 16" width="14"><path fill-rule="evenodd" d="M0 12v3h3l8-8-3-3-8 8zm3 2H1v-2h1v1h1v1zm10.3-9.3L12 6 9 3l1.3-1.3a.996.996 0 0 1 1.41 0l1.59 1.59c.39.39.39 1.02 0 1.41z"/></svg>
        </button>
        <button type="button" class="btn-octicon btn-octicon-danger disabled tooltipped tooltipped-nw"
          aria-label="You must be signed in to make or propose changes">
          <svg aria-hidden="true" class="octicon octicon-trashcan" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M11 2H9c0-.55-.45-1-1-1H5c-.55 0-1 .45-1 1H2c-.55 0-1 .45-1 1v1c0 .55.45 1 1 1v9c0 .55.45 1 1 1h7c.55 0 1-.45 1-1V5c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1zm-1 12H3V5h1v8h1V5h1v8h1V5h1v8h1V5h1v9zm1-10H2V3h9v1z"/></svg>
        </button>
  </div>

  <div class="file-info">
      14 lines (14 sloc)
      <span class="file-info-divider"></span>
    32.6 KB
  </div>
</div>

  

  <div itemprop="text" class="blob-wrapper data type-javascript">
      <table class="highlight tab-size js-file-line-container" data-tab-size="8">
      <tr>
        <td id="L1" class="blob-num js-line-number" data-line-number="1"></td>
        <td id="LC1" class="blob-code blob-code-inner js-file-line"><span class="pl-c">/*!</span></td>
      </tr>
      <tr>
        <td id="L2" class="blob-num js-line-number" data-line-number="2"></td>
        <td id="LC2" class="blob-code blob-code-inner js-file-line"><span class="pl-c"> * jsPDF AutoTable plugin v2.3.2</span></td>
      </tr>
      <tr>
        <td id="L3" class="blob-num js-line-number" data-line-number="3"></td>
        <td id="LC3" class="blob-code blob-code-inner js-file-line"><span class="pl-c"> * Copyright (c) 2014 Simon Bengtsson, https://github.com/simonbengtsson/jsPDF-AutoTable </span></td>
      </tr>
      <tr>
        <td id="L4" class="blob-num js-line-number" data-line-number="4"></td>
        <td id="LC4" class="blob-code blob-code-inner js-file-line"><span class="pl-c"> * </span></td>
      </tr>
      <tr>
        <td id="L5" class="blob-num js-line-number" data-line-number="5"></td>
        <td id="LC5" class="blob-code blob-code-inner js-file-line"><span class="pl-c"> * Licensed under the MIT License.</span></td>
      </tr>
      <tr>
        <td id="L6" class="blob-num js-line-number" data-line-number="6"></td>
        <td id="LC6" class="blob-code blob-code-inner js-file-line"><span class="pl-c"> * http://opensource.org/licenses/mit-license</span></td>
      </tr>
      <tr>
        <td id="L7" class="blob-num js-line-number" data-line-number="7"></td>
        <td id="LC7" class="blob-code blob-code-inner js-file-line"><span class="pl-c"> * </span></td>
      </tr>
      <tr>
        <td id="L8" class="blob-num js-line-number" data-line-number="8"></td>
        <td id="LC8" class="blob-code blob-code-inner js-file-line"><span class="pl-c"> * */</span></td>
      </tr>
      <tr>
        <td id="L9" class="blob-num js-line-number" data-line-number="9"></td>
        <td id="LC9" class="blob-code blob-code-inner js-file-line">&quot;object&quot;==typeof window&amp;&amp;(window.jspdfAutoTableVersion=&quot;2.3.2&quot;),function(t,e){if(&quot;object&quot;==typeof exports&amp;&amp;&quot;object&quot;==typeof module)module.exports=e(require(&quot;jspdf&quot;));else if(&quot;function&quot;==typeof define&amp;&amp;define.amd)define([&quot;jspdf&quot;],e);else{var r=e(&quot;object&quot;==typeof exports?require(&quot;jspdf&quot;):t.jsPDF);for(var o in r)(&quot;object&quot;==typeof exports?exports:t)[o]=r[o]}}(this,function(t){return function(t){function e(o){if(r[o])return r[o].exports;var n=r[o]={i:o,l:!1,exports:{}};return t[o].call(n.exports,n,n.exports,e),n.l=!0,n.exports}var r={};return e.m=t,e.c=r,e.i=function(t){return t},e.d=function(t,r,o){e.o(t,r)||Object.defineProperty(t,r,{configurable:!1,enumerable:!0,get:o})},e.n=function(t){var r=t&amp;&amp;t.__esModule?function(){return t.default}:function(){return t};return e.d(r,&quot;a&quot;,r),r},e.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},e.p=&quot;&quot;,e(e.s=35)}([function(t,e,r){&quot;use strict&quot;;function o(){return{theme:&quot;striped&quot;,styles:{},headerStyles:{},bodyStyles:{},alternateRowStyles:{},columnStyles:{},startY:!1,margin:40/c.scaleFactor(),pageBreak:&quot;auto&quot;,tableWidth:&quot;auto&quot;,showHeader:&quot;everyPage&quot;,tableLineWidth:0,tableLineColor:200,createdHeaderCell:function(t,e){},createdCell:function(t,e){},drawHeaderRow:function(t,e){},drawRow:function(t,e){},drawHeaderCell:function(t,e){},drawCell:function(t,e){},addPageContent:function(t){}}}function n(){var t=c.scaleFactor();return{font:&quot;helvetica&quot;,fontStyle:&quot;normal&quot;,overflow:&quot;ellipsize&quot;,fillColor:!1,textColor:20,halign:&quot;left&quot;,valign:&quot;top&quot;,fontSize:10,cellPadding:5/t,lineColor:200,lineWidth:0/t,columnWidth:&quot;auto&quot;}}e.__esModule=!0,e.FONT_ROW_RATIO=1.15;var i=r(16),a=null,l=r(13),s=r(33);e.getTheme=function(t){return{striped:{table:{fillColor:255,textColor:80,fontStyle:&quot;normal&quot;},header:{textColor:255,fillColor:[41,128,185],fontStyle:&quot;bold&quot;},body:{},alternateRow:{fillColor:245}},grid:{table:{fillColor:255,textColor:80,fontStyle:&quot;normal&quot;,lineWidth:.1},header:{textColor:255,fillColor:[26,188,156],fontStyle:&quot;bold&quot;,lineWidth:0},body:{},alternateRow:{}},plain:{header:{fontStyle:&quot;bold&quot;}}}[t]},e.getDefaults=o;var c=function(){function t(){}return t.pageSize=function(){return a.doc.internal.pageSize},t.applyUserStyles=function(){t.applyStyles(a.userStyles)},t.createTable=function(t){return a=new i.Table(t)},t.tableInstance=function(){return a},t.scaleFactor=function(){return a.doc.internal.scaleFactor},t.hooksData=function(t){return void 0===t&amp;&amp;(t={}),l({pageCount:a.pageCount,settings:a.settings,table:a,doc:a.doc,cursor:a.cursor},t||{})},t.initSettings=function(t,e){for(var r=0,n=Object.keys(t.styles);r&lt;n.length;r++){var i=n[r];!function(r){var o=e.map(function(t){return t[r]||{}});t.styles[r]=l.apply(void 0,[{}].concat(o))}(i)}for(var a=0,c=s(t.hooks);a&lt;c.length;a++)for(var u=c[a],f=u[0],p=u[1],y=0,h=e;y&lt;h.length;y++){var d=h[y];d&amp;&amp;d[f]&amp;&amp;p.push(d[f])}t.settings=l.apply(void 0,[o()].concat(e))},t.marginOrPadding=function(t,e){var r={};if(Array.isArray(t))t.length&gt;=4?r={top:t[0],right:t[1],bottom:t[2],left:t[3]}:3===t.length?r={top:t[0],right:t[1],bottom:t[2],left:t[1]}:2===t.length?r={top:t[0],right:t[1],bottom:t[0],left:t[1]}:t=1===t.length?t[0]:e;else if(&quot;object&quot;==typeof t){t.vertical?(t.top=t.vertical,t.bottom=t.vertical):t.horizontal&amp;&amp;(t.right=t.horizontal,t.left=t.horizontal);for(var o=0,n=[&quot;top&quot;,&quot;right&quot;,&quot;bottom&quot;,&quot;left&quot;];o&lt;n.length;o++){var i=n[o];r[i]=t[i]||0===t[i]?t[i]:e}}return&quot;number&quot;==typeof t&amp;&amp;(r={top:t,right:t,bottom:t,left:t}),r},t.styles=function(t){return t=Array.isArray(t)?t:[t],l.apply(void 0,[n()].concat(t))},t.applyStyles=function(t){var e=a.doc,r={fillColor:e.setFillColor,textColor:e.setTextColor,fontStyle:e.setFontStyle,lineColor:e.setDrawColor,lineWidth:e.setLineWidth,font:e.setFont,fontSize:e.setFontSize};Object.keys(r).forEach(function(e){var o=t[e],n=r[e];void 0!==o&amp;&amp;(Array.isArray(o)?n.apply(this,o):n(o))})},t}();e.Config=c},function(t,e,r){&quot;use strict&quot;;function o(t,e){var r=u.Config.scaleFactor(),o=e.fontSize/r;u.Config.applyStyles(e),t=Array.isArray(t)?t:[t];var n=0;t.forEach(function(t){var e=u.Config.tableInstance().doc.getStringUnitWidth(t);e&gt;n&amp;&amp;(n=e)});var i=1e4*r;return(n=Math.floor(n*i)/i)*o}function n(t,e,r,i){if(void 0===i&amp;&amp;(i=&quot;...&quot;),Array.isArray(t)){var a=[];return t.forEach(function(t,o){a[o]=n(t,e,r,i)}),a}var l=1e4*u.Config.scaleFactor();if((e=Math.ceil(e*l)/l)&gt;=o(t,r))return t;for(;e&lt;o(t+i,r)&amp;&amp;!(t.length&lt;=1);)t=t.substring(0,t.length-1);return t.trim()+i}function i(){var t=u.Config.tableInstance(),e={lineWidth:t.settings.tableLineWidth,lineColor:t.settings.tableLineColor};u.Config.applyStyles(e);var r=s(e);r&amp;&amp;t.doc.rect(t.pageStartX,t.pageStartY,t.width,t.cursor.y-t.pageStartY,r)}function a(){var t=u.Config.tableInstance();t.finalY=t.cursor.y,l(),i(),c(t.doc),t.pageCount++,t.cursor={x:t.margin(&quot;left&quot;),y:t.margin(&quot;top&quot;)},t.pageStartX=t.cursor.x,t.pageStartY=t.cursor.y,!0!==t.settings.showHeader&amp;&amp;&quot;everyPage&quot;!==t.settings.showHeader||f.printRow(t.headerRow,t.hooks.drawHeaderRow,t.hooks.drawHeaderCell)}function l(){for(var t=0,e=u.Config.tableInstance().hooks.addPageContent;t&lt;e.length;t++){var r=e[t];u.Config.applyUserStyles(),r(u.Config.hooksData())}u.Config.applyUserStyles()}function s(t){var e=t.lineWidth&gt;0,r=t.fillColor||0===t.fillColor;return e&amp;&amp;r?&quot;DF&quot;:e?&quot;S&quot;:!!r&amp;&amp;&quot;F&quot;}function c(t){var e=t.internal.getCurrentPageInfo().pageNumber;t.setPage(e+1),t.internal.getCurrentPageInfo().pageNumber===e&amp;&amp;t.addPage()}e.__esModule=!0;var u=r(0),f=r(4);e.getStringWidth=o,e.ellipsize=n,e.addTableBorder=i,e.addPage=a,e.addContentHooks=l,e.getFillStyle=s,e.nextPage=c},function(t,e,r){var o=r(27);t.exports=Function.prototype.bind||o},function(t,e,r){&quot;use strict&quot;;var o=Function.prototype.toString,n=/^\s*class /,i=function(t){try{var e=o.call(t),r=e.replace(/\/\/.*\n/g,&quot;&quot;),i=r.replace(/\/\*[.\s\S]*\*\//g,&quot;&quot;),a=i.replace(/\n/gm,&quot; &quot;).replace(/ {2}/g,&quot; &quot;);return n.test(a)}catch(t){return!1}},a=function(t){try{return!i(t)&amp;&amp;(o.call(t),!0)}catch(t){return!1}},l=Object.prototype.toString,s=&quot;function&quot;==typeof Symbol&amp;&amp;&quot;symbol&quot;==typeof Symbol.toStringTag;t.exports=function(t){if(!t)return!1;if(&quot;function&quot;!=typeof t&amp;&amp;&quot;object&quot;!=typeof t)return!1;if(s)return a(t);if(i(t))return!1;var e=l.call(t);return&quot;[object Function]&quot;===e||&quot;[object GeneratorFunction]&quot;===e}},function(t,e,r){&quot;use strict&quot;;function o(t,e,r){var s=0,c={},u=a.Config.tableInstance();if(!i(t.height))if(t.maxLineCount&lt;=1)l.addPage();else{t.spansMultiplePages=!0;for(var f=u.doc.internal.pageSize.height,p=0,y=0;y&lt;u.columns.length;y++){var h=u.columns[y],d=t.cells[h.dataKey],g=d.styles.fontSize/a.Config.scaleFactor()*a.FONT_ROW_RATIO,b=d.padding(&quot;vertical&quot;),v=f-u.cursor.y-u.margin(&quot;bottom&quot;),m=Math.floor((v-b)/g);if(Array.isArray(d.text)&amp;&amp;d.text.length&gt;m){var w=d.text.splice(m,d.text.length);c[h.dataKey]=w;var S=d.text.length*g+b;S&gt;p&amp;&amp;(p=S);var T=w.length*g+b;T&gt;s&amp;&amp;(s=T)}}t.height=p}if(n(t,e,r),Object.keys(c).length&gt;0){for(var y=0;y&lt;u.columns.length;y++){var h=u.columns[y],d=t.cells[h.dataKey];d.text=c[h.dataKey]||&quot;&quot;}l.addPage(),t.pageCount++,t.height=s,o(t,e,r)}}function n(t,e,r){var o=a.Config.tableInstance();t.y=o.cursor.y;for(var n=0,i=e;n&lt;i.length;n++){var s=i[n];if(!1===s(t,a.Config.hooksData({row:t,addPage:l.addPage})))return}o.cursor.x=o.margin(&quot;left&quot;);for(var c=0;c&lt;o.columns.length;c++){var u=o.columns[c],f=t.cells[u.dataKey];if(f){a.Config.applyStyles(f.styles),f.x=o.cursor.x,f.y=o.cursor.y,f.height=t.height,f.width=u.width,&quot;top&quot;===f.styles.valign?f.textPos.y=o.cursor.y+f.padding(&quot;top&quot;):&quot;bottom&quot;===f.styles.valign?f.textPos.y=o.cursor.y+t.height-f.padding(&quot;bottom&quot;):f.textPos.y=o.cursor.y+t.height/2,&quot;right&quot;===f.styles.halign?f.textPos.x=f.x+f.width-f.padding(&quot;right&quot;):&quot;center&quot;===f.styles.halign?f.textPos.x=f.x+f.width/2:f.textPos.x=f.x+f.padding(&quot;left&quot;);for(var p=!0,y=a.Config.hooksData({column:u,row:t,addPage:l.addPage}),h=0,d=r;h&lt;d.length;h++){var s=d[h];!1===s(f,y)&amp;&amp;(p=!1)}if(p){var g=l.getFillStyle(f.styles);g&amp;&amp;o.doc.rect(f.x,f.y,f.width,f.height,g),o.doc.autoTableText(f.text,f.textPos.x,f.textPos.y,{halign:f.styles.halign,valign:f.styles.valign})}o.cursor.x+=f.width}}o.cursor.y+=t.height}function i(t){var e=a.Config.tableInstance();return t+e.cursor.y+e.margin(&quot;bottom&quot;)&lt;a.Config.pageSize().height}e.__esModule=!0;var a=r(0),l=r(1);e.printFullRow=o,e.printRow=n},function(t,e,r){&quot;use strict&quot;;var o=r(31),n=r(26),i=&quot;function&quot;==typeof Symbol&amp;&amp;&quot;symbol&quot;==typeof Symbol(),a=Object.prototype.toString,l=function(t){return&quot;function&quot;==typeof t&amp;&amp;&quot;[object Function]&quot;===a.call(t)},s=Object.defineProperty&amp;&amp;function(){var t={};try{Object.defineProperty(t,&quot;x&quot;,{enumerable:!1,value:t});for(var e in t)return!1;return t.x===t}catch(t){return!1}}(),c=function(t,e,r,o){(!(e in t)||l(o)&amp;&amp;o())&amp;&amp;(s?Object.defineProperty(t,e,{configurable:!0,enumerable:!1,value:r,writable:!0}):t[e]=r)},u=function(t,e){var r=arguments.length&gt;2?arguments[2]:{},a=o(e);i&amp;&amp;(a=a.concat(Object.getOwnPropertySymbols(e))),n(a,function(o){c(t,o,e[o],r[o])})};u.supportsDescriptors=!!s,t.exports=u},function(t,e){var r=Object.prototype.hasOwnProperty;t.exports=Object.assign||function(t,e){for(var o in e)r.call(e,o)&amp;&amp;(t[o]=e[o]);return t}},function(t,e){var r=Number.isNaN||function(t){return t!==t};t.exports=Number.isFinite||function(t){return&quot;number&quot;==typeof t&amp;&amp;!r(t)&amp;&amp;t!==1/0&amp;&amp;t!==-1/0}},function(t,e){t.exports=Number.isNaN||function(t){return t!==t}},function(t,e){t.exports=function(t,e){var r=t%e;return Math.floor(r&gt;=0?r:r+e)}},function(t,e){t.exports=function(t){return t&gt;=0?1:-1}},function(t,e){t.exports=function(t){return null===t||&quot;function&quot;!=typeof t&amp;&amp;&quot;object&quot;!=typeof t}},function(t,e,r){var o=r(2);t.exports=o.call(Function.call,Object.prototype.hasOwnProperty)},function(t,e,r){&quot;use strict&quot;;function o(t){if(null===t||void 0===t)throw new TypeError(&quot;Object.assign cannot be called with null or undefined&quot;);return Object(t)}/*</td>
      </tr>
      <tr>
        <td id="L10" class="blob-num js-line-number" data-line-number="10"></td>
        <td id="LC10" class="blob-code blob-code-inner js-file-line">object<span class="pl-k">-</span>assign</td>
      </tr>
      <tr>
        <td id="L11" class="blob-num js-line-number" data-line-number="11"></td>
        <td id="LC11" class="blob-code blob-code-inner js-file-line">(c) Sindre Sorhus</td>
      </tr>
      <tr>
        <td id="L12" class="blob-num js-line-number" data-line-number="12"></td>
        <td id="LC12" class="blob-code blob-code-inner js-file-line">@license <span class="pl-c1">MIT</span></td>
      </tr>
      <tr>
        <td id="L13" class="blob-num js-line-number" data-line-number="13"></td>
        <td id="LC13" class="blob-code blob-code-inner js-file-line"><span class="pl-k">*/</span></td>
      </tr>
      <tr>
        <td id="L14" class="blob-num js-line-number" data-line-number="14"></td>
        <td id="LC14" class="blob-code blob-code-inner js-file-line">var n=Object.getOwnPropertySymbols,i=Object.prototype.hasOwnProperty,a=Object.prototype.propertyIsEnumerable;t.exports=function(){try{if(!Object.assign)return!1;var t=new String(&quot;abc&quot;);if(t[5]=&quot;de&quot;,&quot;5&quot;===Object.getOwnPropertyNames(t)[0])return!1;for(var e={},r=0;r&lt;10;r++)e[&quot;_&quot;+String.fromCharCode(r)]=r;if(&quot;0123456789&quot;!==Object.getOwnPropertyNames(e).map(function(t){return e[t]}).join(&quot;&quot;))return!1;var o={};return&quot;abcdefghijklmnopqrst&quot;.split(&quot;&quot;).forEach(function(t){o[t]=t}),&quot;abcdefghijklmnopqrst&quot;===Object.keys(Object.assign({},o)).join(&quot;&quot;)}catch(t){return!1}}()?Object.assign:function(t,e){for(var r,l,s=o(t),c=1;c&lt;arguments.length;c++){r=Object(arguments[c]);for(var u in r)i.call(r,u)&amp;&amp;(s[u]=r[u]);if(n){l=n(r);for(var f=0;f&lt;l.length;f++)a.call(r,l[f])&amp;&amp;(s[l[f]]=r[l[f]])}}return s}},function(t,e,r){&quot;use strict&quot;;var o=r(22),n=r(12),i=r(2),a=i.call(Function.call,Object.prototype.propertyIsEnumerable);t.exports=function(t){var e=o.RequireObjectCoercible(t),r=[];for(var i in e)n(e,i)&amp;&amp;a(e,i)&amp;&amp;r.push([i,e[i]]);return r}},function(t,e,r){&quot;use strict&quot;;var o=r(14);t.exports=function(){return&quot;function&quot;==typeof Object.entries?Object.entries:o}},function(t,e,r){&quot;use strict&quot;;e.__esModule=!0;var o=r(0);e.table={};var n=function(){function t(t){this.height=0,this.width=0,this.contentWidth=0,this.preferredWidth=0,this.rows=[],this.columns=[],this.headerRow=null,this.pageCount=1,this.hooks={createdHeaderCell:[],createdCell:[],drawHeaderRow:[],drawRow:[],drawHeaderCell:[],drawCell:[],addPageContent:[]},this.styles={styles:{},headerStyles:{},bodyStyles:{},alternateRowStyles:{},columnStyles:{}},this.doc=t,this.userStyles={textColor:30,fontSize:t.internal.getFontSize(),fontStyle:t.internal.getFont().fontStyle}}return t.prototype.margin=function(t){return o.Config.marginOrPadding(this.settings.margin,o.getDefaults().margin)[t]},t}();e.Table=n;var i=function(){function t(t,e){this.cells={},this.spansMultiplePages=!1,this.pageCount=1,this.height=0,this.y=0,this.maxLineCount=1,this.raw=t,this.index=e}return t}();e.Row=i;var a=function(){function t(t){this.styles={},this.text=&quot;&quot;,this.contentWidth=0,this.textPos={},this.height=0,this.width=0,this.x=0,this.y=0,this.raw=t}return t.prototype.padding=function(t){var e=o.Config.marginOrPadding(this.styles.cellPadding,o.Config.styles([]).cellPadding);return&quot;vertical&quot;===t?e.top+e.bottom:&quot;horizontal&quot;===t?e.left+e.right:e[t]},t}();e.Cell=a;var l=function(){function t(t,e){this.options={},this.contentWidth=0,this.preferredWidth=0,this.widthStyle=&quot;auto&quot;,this.width=0,this.x=0,this.dataKey=t,this.index=e}return t}();e.Column=l},function(t,e,r){&quot;use strict&quot;;function o(t,e){var r=i.Config.tableInstance(),o=0,l=0,s=[];r.columns.forEach(function(t){t.contentWidth=0,r.rows.concat(r.headerRow).forEach(function(e){var r=e.cells[t.dataKey];r.contentWidth=r.padding(&quot;horizontal&quot;)+a.getStringWidth(r.text,r.styles),r.contentWidth&gt;t.contentWidth&amp;&amp;(t.contentWidth=r.contentWidth)}),r.contentWidth+=t.contentWidth,&quot;number&quot;==typeof t.widthStyle?(t.preferredWidth=t.widthStyle,o+=t.preferredWidth,t.width=t.preferredWidth):&quot;wrap&quot;===t.widthStyle?(t.preferredWidth=t.contentWidth,o+=t.preferredWidth,t.width=t.preferredWidth):(t.preferredWidth=t.contentWidth,l+=t.contentWidth,s.push(t)),r.preferredWidth+=t.preferredWidth}),&quot;number&quot;==typeof r.settings.tableWidth?r.width=r.settings.tableWidth:&quot;wrap&quot;===r.settings.tableWidth?r.width=r.preferredWidth:r.width=e-r.margin(&quot;left&quot;)-r.margin(&quot;right&quot;),n(s,o,l,0),r.rows.concat(r.headerRow).forEach(function(e){r.columns.forEach(function(r){var o=e.cells[r.dataKey];i.Config.applyStyles(o.styles);var n=r.width-o.padding(&quot;horizontal&quot;);if(&quot;linebreak&quot;===o.styles.overflow)try{o.text=t.splitTextToSize(o.text,n+1,{fontSize:o.styles.fontSize})}catch(e){if(!(e instanceof TypeError&amp;&amp;Array.isArray(o.text)))throw e;o.text=t.splitTextToSize(o.text.join(&quot; &quot;),n+1,{fontSize:o.styles.fontSize})}else&quot;ellipsize&quot;===o.styles.overflow?o.text=a.ellipsize(o.text,n,o.styles):&quot;visible&quot;===o.styles.overflow||(&quot;hidden&quot;===o.styles.overflow?o.text=a.ellipsize(o.text,n,o.styles,&quot;&quot;):&quot;function&quot;==typeof o.styles.overflow?o.text=o.styles.overflow(o.text,n):console.error(&quot;Unrecognized overflow type: &quot;+o.styles.overflow));var l=i.Config.scaleFactor(),s=Array.isArray(o.text)?o.text.length:1,c=o.styles.fontSize/l*i.FONT_ROW_RATIO;o.contentHeight=s*c+o.padding(&quot;vertical&quot;),o.contentHeight&gt;e.height&amp;&amp;(e.height=o.contentHeight,e.maxLineCount=s)}),r.height+=e.height})}function n(t,e,r,o){for(var a=i.Config.tableInstance(),l=a.width-e-r,s=0;s&lt;t.length;s++){var c=t[s],u=c.contentWidth/r,f=c.contentWidth+l*u&lt;o;if(l&lt;0&amp;&amp;f){t.splice(s,1),r-=c.contentWidth,c.width=o,e+=c.width,n(t,e,r,o);break}c.width=c.contentWidth+l*u}}e.__esModule=!0;var i=r(0),a=r(1);e.calculateWidths=o},function(t,e,r){&quot;use strict&quot;;function o(t,e,r){t&amp;&amp;&quot;object&quot;==typeof t||console.error(&quot;The headers should be an object or array, is: &quot;+typeof t),e&amp;&amp;&quot;object&quot;==typeof e||console.error(&quot;The data should be an object or array, is: &quot;+typeof e);for(var o=0,n=r;o&lt;n.length;o++){var i=n[o];!function(t){t&amp;&amp;&quot;object&quot;!=typeof t&amp;&amp;console.error(&quot;The options parameter should be of type object, is: &quot;+typeof t),void 0!==t.extendWidth&amp;&amp;(t.tableWidth=t.extendWidth?&quot;auto&quot;:&quot;wrap&quot;,console.error(&quot;Use of deprecated option: extendWidth, use tableWidth instead.&quot;)),void 0!==t.margins&amp;&amp;(void 0===t.margin&amp;&amp;(t.margin=t.margins),console.error(&quot;Use of deprecated option: margins, use margin instead.&quot;)),void 0===t.afterPageContent&amp;&amp;void 0===t.beforePageContent&amp;&amp;void 0===t.afterPageAdd||(console.error(&quot;The afterPageContent, beforePageContent and afterPageAdd hooks are deprecated. Use addPageContent instead&quot;),void 0===t.addPageContent&amp;&amp;(t.addPageContent=function(e){a.Config.applyUserStyles(),t.beforePageContent&amp;&amp;t.beforePageContent(e),a.Config.applyUserStyles(),t.afterPageContent&amp;&amp;t.afterPageContent(e),a.Config.applyUserStyles(),t.afterPageAdd&amp;&amp;e.pageCount&gt;1&amp;&amp;e.afterPageAdd(e),a.Config.applyUserStyles()})),[[&quot;padding&quot;,&quot;cellPadding&quot;],[&quot;lineHeight&quot;,&quot;rowHeight&quot;],&quot;fontSize&quot;,&quot;overflow&quot;].forEach(function(e){var r=&quot;string&quot;==typeof e?e:e[0],o=&quot;string&quot;==typeof e?e:e[1];void 0!==t[r]&amp;&amp;(void 0===t.styles[o]&amp;&amp;(t.styles[o]=t[r]),console.error(&quot;Use of deprecated option: &quot;+r+&quot;, use the style &quot;+o+&quot; instead.&quot;))});for(var e=0,r=[&quot;styles&quot;,&quot;bodyStyles&quot;,&quot;headerStyles&quot;,&quot;columnStyles&quot;];e&lt;r.length;e++){var o=r[e];t[o]&amp;&amp;&quot;object&quot;!=typeof t[o]?console.error(&quot;The &quot;+o+&quot; style should be of type object, is: &quot;+typeof t[o]):t[o]&amp;&amp;t[o].rowHeight&amp;&amp;console.error(&quot;Use of deprecated style: rowHeight, use vertical cell padding instead&quot;)}}(i)}}function n(t,e){var r=a.Config.tableInstance(),o=r.settings,n=a.getTheme(o.theme),s=new i.Row(t,-1);s.index=-1,t.forEach(function(t,e){var l=e;void 0!==t.dataKey?l=t.dataKey:void 0!==t.key&amp;&amp;(console.error(&quot;Deprecation warning: Use dataKey instead of key&quot;),l=t.key);var c=new i.Column(l,e);c.raw=t,c.widthStyle=a.Config.styles([n.table,n.header,r.styles.styles,r.styles.columnStyles[c.dataKey]||{}]).columnWidth,r.columns.push(c);var u=new i.Cell(t);if(u.styles=a.Config.styles([n.table,n.header,r.styles.styles,r.styles.headerStyles]),u.raw instanceof HTMLElement)u.text=(u.raw.innerText||&quot;&quot;).trim();else{var f=&quot;object&quot;==typeof u.raw?u.raw.title:u.raw;u.text=void 0!==u.raw?&quot;&quot;+f:&quot;&quot;}u.text=u.text.split(/\r\n|\r|\n/g),s.cells[l]=u;for(var p=0,y=r.hooks.createdHeaderCell;p&lt;y.length;p++){(0,y[p])(u,{cell:u,column:c,row:s,settings:o})}}),r.headerRow=s,e.forEach(function(t,e){var o=new i.Row(t,e),s=e%2==0?l({},n.alternateRow,r.styles.alternateRowStyles):{};r.columns.forEach(function(e){var l=new i.Cell(t[e.dataKey]),c=r.styles.columnStyles[e.dataKey]||{};l.styles=a.Config.styles([n.table,n.body,r.styles.styles,r.styles.bodyStyles,s,c]),l.raw&amp;&amp;l.raw instanceof HTMLElement?l.text=(l.raw.innerText||&quot;&quot;).trim():l.text=void 0!==l.raw?&quot;&quot;+l.raw:&quot;&quot;,l.text=l.text.split(/\r\n|\r|\n/g),o.cells[e.dataKey]=l;for(var u=0,f=r.hooks.createdCell;u&lt;f.length;u++){(0,f[u])(l,a.Config.hooksData({cell:l,column:e,row:o}))}}),r.rows.push(o)})}e.__esModule=!0;var i=r(16),a=r(0),l=r(13);e.validateInput=o,e.createModels=n},function(e,r){e.exports=t},function(t,e,r){&quot;use strict&quot;;var o=r(8),n=r(7),i=r(10),a=r(9),l=r(3),s=r(24),c={ToPrimitive:s,ToBoolean:function(t){return Boolean(t)},ToNumber:function(t){return Number(t)},ToInteger:function(t){var e=this.ToNumber(t);return o(e)?0:0!==e&amp;&amp;n(e)?i(e)*Math.floor(Math.abs(e)):e},ToInt32:function(t){return this.ToNumber(t)&gt;&gt;0},ToUint32:function(t){return this.ToNumber(t)&gt;&gt;&gt;0},ToUint16:function(t){var e=this.ToNumber(t);if(o(e)||0===e||!n(e))return 0;var r=i(e)*Math.floor(Math.abs(e));return a(r,65536)},ToString:function(t){return String(t)},ToObject:function(t){return this.CheckObjectCoercible(t),Object(t)},CheckObjectCoercible:function(t,e){if(null==t)throw new TypeError(e||&quot;Cannot call method on &quot;+t);return t},IsCallable:l,SameValue:function(t,e){return t===e?0!==t||1/t==1/e:o(t)&amp;&amp;o(e)},Type:function(t){return null===t?&quot;Null&quot;:void 0===t?&quot;Undefined&quot;:&quot;function&quot;==typeof t||&quot;object&quot;==typeof t?&quot;Object&quot;:&quot;number&quot;==typeof t?&quot;Number&quot;:&quot;boolean&quot;==typeof t?&quot;Boolean&quot;:&quot;string&quot;==typeof t?&quot;String&quot;:void 0}};t.exports=c},function(t,e,r){&quot;use strict&quot;;var o=Object.prototype.toString,n=&quot;function&quot;==typeof Symbol&amp;&amp;&quot;symbol&quot;==typeof Symbol.iterator,i=n?Symbol.prototype.toString:o,a=r(8),l=r(7),s=Number.MAX_SAFE_INTEGER||Math.pow(2,53)-1,c=r(6),u=r(10),f=r(9),p=r(23),y=r(25),h=parseInt,d=r(2),g=d.call(Function.call,String.prototype.slice),b=d.call(Function.call,RegExp.prototype.test,/^0b[01]+$/i),v=d.call(Function.call,RegExp.prototype.test,/^0o[0-7]+$/i),m=[&quot;&quot;,&quot;​&quot;,&quot;￾&quot;].join(&quot;&quot;),w=new RegExp(&quot;[&quot;+m+&quot;]&quot;,&quot;g&quot;),S=d.call(Function.call,RegExp.prototype.test,w),T=d.call(Function.call,RegExp.prototype.test,/^[-+]0x[0-9a-f]+$/i),x=[&quot;\t\n\v\f\r   ᠎    &quot;,&quot;         　\u2028&quot;,&quot;\u2029\ufeff&quot;].join(&quot;&quot;),C=new RegExp(&quot;(^[&quot;+x+&quot;]+)|([&quot;+x+&quot;]+$)&quot;,&quot;g&quot;),j=d.call(Function.call,String.prototype.replace),O=function(t){return j(t,C,&quot;&quot;)},P=r(20),I=r(29),E=c(c({},P),{Call:function(t,e){var r=arguments.length&gt;2?arguments[2]:[];if(!this.IsCallable(t))throw new TypeError(t+&quot; is not a function&quot;);return t.apply(e,r)},ToPrimitive:y,ToNumber:function(t){var e=p(t)?t:y(t,&quot;number&quot;);if(&quot;symbol&quot;==typeof e)throw new TypeError(&quot;Cannot convert a Symbol value to a number&quot;);if(&quot;string&quot;==typeof e){if(b(e))return this.ToNumber(h(g(e,2),2));if(v(e))return this.ToNumber(h(g(e,2),8));if(S(e)||T(e))return NaN;var r=O(e);if(r!==e)return this.ToNumber(r)}return Number(e)},ToInt16:function(t){var e=this.ToUint16(t);return e&gt;=32768?e-65536:e},ToInt8:function(t){var e=this.ToUint8(t);return e&gt;=128?e-256:e},ToUint8:function(t){var e=this.ToNumber(t);if(a(e)||0===e||!l(e))return 0;var r=u(e)*Math.floor(Math.abs(e));return f(r,256)},ToUint8Clamp:function(t){var e=this.ToNumber(t);if(a(e)||e&lt;=0)return 0;if(e&gt;=255)return 255;var r=Math.floor(t);return r+.5&lt;e?r+1:e&lt;r+.5?r:r%2!=0?r+1:r},ToString:function(t){if(&quot;symbol&quot;==typeof t)throw new TypeError(&quot;Cannot convert a Symbol value to a string&quot;);return String(t)},ToObject:function(t){return this.RequireObjectCoercible(t),Object(t)},ToPropertyKey:function(t){var e=this.ToPrimitive(t,String);return&quot;symbol&quot;==typeof e?i.call(e):this.ToString(e)},ToLength:function(t){var e=this.ToInteger(t);return e&lt;=0?0:e&gt;s?s:e},CanonicalNumericIndexString:function(t){if(&quot;[object String]&quot;!==o.call(t))throw new TypeError(&quot;must be a string&quot;);if(&quot;-0&quot;===t)return-0;var e=this.ToNumber(t);return this.SameValue(this.ToString(e),t)?e:void 0},RequireObjectCoercible:P.CheckObjectCoercible,IsArray:Array.isArray||function(t){return&quot;[object Array]&quot;===o.call(t)},IsConstructor:function(t){return&quot;function&quot;==typeof t&amp;&amp;!!t.prototype},IsExtensible:function(t){return!Object.preventExtensions||!p(t)&amp;&amp;Object.isExtensible(t)},IsInteger:function(t){if(&quot;number&quot;!=typeof t||a(t)||!l(t))return!1;var e=Math.abs(t);return Math.floor(e)===e},IsPropertyKey:function(t){return&quot;string&quot;==typeof t||&quot;symbol&quot;==typeof t},IsRegExp:function(t){if(!t||&quot;object&quot;!=typeof t)return!1;if(n){var e=t[Symbol.match];if(void 0!==e)return P.ToBoolean(e)}return I(t)},SameValueZero:function(t,e){return t===e||a(t)&amp;&amp;a(e)},GetV:function(t,e){if(!this.IsPropertyKey(e))throw new TypeError(&quot;Assertion failed: IsPropertyKey(P) is not true&quot;);return this.ToObject(t)[e]},GetMethod:function(t,e){if(!this.IsPropertyKey(e))throw new TypeError(&quot;Assertion failed: IsPropertyKey(P) is not true&quot;);var r=this.GetV(t,e);if(null!=r){if(!this.IsCallable(r))throw new TypeError(e+&quot;is not a function&quot;);return r}},Get:function(t,e){if(&quot;Object&quot;!==this.Type(t))throw new TypeError(&quot;Assertion failed: Type(O) is not Object&quot;);if(!this.IsPropertyKey(e))throw new TypeError(&quot;Assertion failed: IsPropertyKey(P) is not true&quot;);return t[e]},Type:function(t){return&quot;symbol&quot;==typeof t?&quot;Symbol&quot;:P.Type(t)},SpeciesConstructor:function(t,e){if(&quot;Object&quot;!==this.Type(t))throw new TypeError(&quot;Assertion failed: Type(O) is not Object&quot;);var r=t.constructor;if(void 0===r)return e;if(&quot;Object&quot;!==this.Type(r))throw new TypeError(&quot;O.constructor is not an Object&quot;);var o=n&amp;&amp;Symbol.species?r[Symbol.species]:void 0;if(null==o)return e;if(this.IsConstructor(o))return o;throw new TypeError(&quot;no constructor found&quot;)}});delete E.CheckObjectCoercible,t.exports=E},function(t,e,r){&quot;use strict&quot;;var o=r(21),n=r(6),i=n(o,{SameValueNonNumber:function(t,e){if(&quot;number&quot;==typeof t||typeof t!=typeof e)throw new TypeError(&quot;SameValueNonNumber requires two non-number values of the same type.&quot;);return this.SameValue(t,e)}});t.exports=i},function(t,e){t.exports=function(t){return null===t||&quot;function&quot;!=typeof t&amp;&amp;&quot;object&quot;!=typeof t}},function(t,e,r){&quot;use strict&quot;;var o=Object.prototype.toString,n=r(11),i=r(3),a={&quot;[[DefaultValue]]&quot;:function(t,e){var r=e||(&quot;[object Date]&quot;===o.call(t)?String:Number);if(r===String||r===Number){var a,l,s=r===String?[&quot;toString&quot;,&quot;valueOf&quot;]:[&quot;valueOf&quot;,&quot;toString&quot;];for(l=0;l&lt;s.length;++l)if(i(t[s[l]])&amp;&amp;(a=t[s[l]](),n(a)))return a;throw new TypeError(&quot;No default value&quot;)}throw new TypeError(&quot;invalid [[DefaultValue]] hint supplied&quot;)}};t.exports=function(t,e){return n(t)?t:a[&quot;[[DefaultValue]]&quot;](t,e)}},function(t,e,r){&quot;use strict&quot;;var o=&quot;function&quot;==typeof Symbol&amp;&amp;&quot;symbol&quot;==typeof Symbol.iterator,n=r(11),i=r(3),a=r(28),l=r(30),s=function(t,e){if(void 0===t||null===t)throw new TypeError(&quot;Cannot call method on &quot;+t);if(&quot;string&quot;!=typeof e||&quot;number&quot;!==e&amp;&amp;&quot;string&quot;!==e)throw new TypeError(&#39;hint must be &quot;string&quot; or &quot;number&quot;&#39;);var r,o,a,l=&quot;string&quot;===e?[&quot;toString&quot;,&quot;valueOf&quot;]:[&quot;valueOf&quot;,&quot;toString&quot;];for(a=0;a&lt;l.length;++a)if(r=t[l[a]],i(r)&amp;&amp;(o=r.call(t),n(o)))return o;throw new TypeError(&quot;No default value&quot;)},c=function(t,e){var r=t[e];if(null!==r&amp;&amp;void 0!==r){if(!i(r))throw new TypeError(r+&quot; returned for property &quot;+e+&quot; of object &quot;+t+&quot; is not a function&quot;);return r}};t.exports=function(t,e){if(n(t))return t;var r=&quot;default&quot;;arguments.length&gt;1&amp;&amp;(e===String?r=&quot;string&quot;:e===Number&amp;&amp;(r=&quot;number&quot;));var i;if(o&amp;&amp;(Symbol.toPrimitive?i=c(t,Symbol.toPrimitive):l(t)&amp;&amp;(i=Symbol.prototype.valueOf)),void 0!==i){var u=i.call(t,r);if(n(u))return u;throw new TypeError(&quot;unable to convert exotic object to primitive&quot;)}return&quot;default&quot;===r&amp;&amp;(a(t)||l(t))&amp;&amp;(r=&quot;string&quot;),s(t,&quot;default&quot;===r?&quot;number&quot;:r)}},function(t,e){var r=Object.prototype.hasOwnProperty,o=Object.prototype.toString;t.exports=function(t,e,n){if(&quot;[object Function]&quot;!==o.call(e))throw new TypeError(&quot;iterator must be a function&quot;);var i=t.length;if(i===+i)for(var a=0;a&lt;i;a++)e.call(n,t[a],a,t);else for(var l in t)r.call(t,l)&amp;&amp;e.call(n,t[l],l,t)}},function(t,e){var r=Array.prototype.slice,o=Object.prototype.toString;t.exports=function(t){var e=this;if(&quot;function&quot;!=typeof e||&quot;[object Function]&quot;!==o.call(e))throw new TypeError(&quot;Function.prototype.bind called on incompatible &quot;+e);for(var n,i=r.call(arguments,1),a=function(){if(this instanceof n){var o=e.apply(this,i.concat(r.call(arguments)));return Object(o)===o?o:this}return e.apply(t,i.concat(r.call(arguments)))},l=Math.max(0,e.length-i.length),s=[],c=0;c&lt;l;c++)s.push(&quot;$&quot;+c);if(n=Function(&quot;binder&quot;,&quot;return function (&quot;+s.join(&quot;,&quot;)+&quot;){ return binder.apply(this,arguments); }&quot;)(a),e.prototype){var u=function(){};u.prototype=e.prototype,n.prototype=new u,u.prototype=null}return n}},function(t,e,r){&quot;use strict&quot;;var o=Date.prototype.getDay,n=function(t){try{return o.call(t),!0}catch(t){return!1}},i=Object.prototype.toString,a=&quot;function&quot;==typeof Symbol&amp;&amp;&quot;symbol&quot;==typeof Symbol.toStringTag;t.exports=function(t){return&quot;object&quot;==typeof t&amp;&amp;null!==t&amp;&amp;(a?n(t):&quot;[object Date]&quot;===i.call(t))}},function(t,e,r){&quot;use strict&quot;;var o=r(12),n=RegExp.prototype.exec,i=Object.getOwnPropertyDescriptor,a=function(t){try{var e=t.lastIndex;return t.lastIndex=0,n.call(t),!0}catch(t){return!1}finally{t.lastIndex=e}},l=Object.prototype.toString,s=&quot;function&quot;==typeof Symbol&amp;&amp;&quot;symbol&quot;==typeof Symbol.toStringTag;t.exports=function(t){if(!t||&quot;object&quot;!=typeof t)return!1;if(!s)return&quot;[object RegExp]&quot;===l.call(t);var e=i(t,&quot;lastIndex&quot;);return!(!e||!o(e,&quot;value&quot;))&amp;&amp;a(t)}},function(t,e,r){&quot;use strict&quot;;var o=Object.prototype.toString;if(&quot;function&quot;==typeof Symbol&amp;&amp;&quot;symbol&quot;==typeof Symbol()){var n=Symbol.prototype.toString,i=/^Symbol\(.*\)$/,a=function(t){return&quot;symbol&quot;==typeof t.valueOf()&amp;&amp;i.test(n.call(t))};t.exports=function(t){if(&quot;symbol&quot;==typeof t)return!0;if(&quot;[object Symbol]&quot;!==o.call(t))return!1;try{return a(t)}catch(t){return!1}}}else t.exports=function(t){return!1}},function(t,e,r){&quot;use strict&quot;;var o=Object.prototype.hasOwnProperty,n=Object.prototype.toString,i=Array.prototype.slice,a=r(32),l=Object.prototype.propertyIsEnumerable,s=!l.call({toString:null},&quot;toString&quot;),c=l.call(function(){},&quot;prototype&quot;),u=[&quot;toString&quot;,&quot;toLocaleString&quot;,&quot;valueOf&quot;,&quot;hasOwnProperty&quot;,&quot;isPrototypeOf&quot;,&quot;propertyIsEnumerable&quot;,&quot;constructor&quot;],f=function(t){var e=t.constructor;return e&amp;&amp;e.prototype===t},p={$console:!0,$external:!0,$frame:!0,$frameElement:!0,$frames:!0,$innerHeight:!0,$innerWidth:!0,$outerHeight:!0,$outerWidth:!0,$pageXOffset:!0,$pageYOffset:!0,$parent:!0,$scrollLeft:!0,$scrollTop:!0,$scrollX:!0,$scrollY:!0,$self:!0,$webkitIndexedDB:!0,$webkitStorageInfo:!0,$window:!0},y=function(){if(&quot;undefined&quot;==typeof window)return!1;for(var t in window)try{if(!p[&quot;$&quot;+t]&amp;&amp;o.call(window,t)&amp;&amp;null!==window[t]&amp;&amp;&quot;object&quot;==typeof window[t])try{f(window[t])}catch(t){return!0}}catch(t){return!0}return!1}(),h=function(t){if(&quot;undefined&quot;==typeof window||!y)return f(t);try{return f(t)}catch(t){return!1}},d=function(t){var e=null!==t&amp;&amp;&quot;object&quot;==typeof t,r=&quot;[object Function]&quot;===n.call(t),i=a(t),l=e&amp;&amp;&quot;[object String]&quot;===n.call(t),f=[];if(!e&amp;&amp;!r&amp;&amp;!i)throw new TypeError(&quot;Object.keys called on a non-object&quot;);var p=c&amp;&amp;r;if(l&amp;&amp;t.length&gt;0&amp;&amp;!o.call(t,0))for(var y=0;y&lt;t.length;++y)f.push(String(y));if(i&amp;&amp;t.length&gt;0)for(var d=0;d&lt;t.length;++d)f.push(String(d));else for(var g in t)p&amp;&amp;&quot;prototype&quot;===g||!o.call(t,g)||f.push(String(g));if(s)for(var b=h(t),v=0;v&lt;u.length;++v)b&amp;&amp;&quot;constructor&quot;===u[v]||!o.call(t,u[v])||f.push(u[v]);return f};d.shim=function(){if(Object.keys){if(!function(){return 2===(Object.keys(arguments)||&quot;&quot;).length}(1,2)){var t=Object.keys;Object.keys=function(e){return t(a(e)?i.call(e):e)}}}else Object.keys=d;return Object.keys||d},t.exports=d},function(t,e,r){&quot;use strict&quot;;var o=Object.prototype.toString;t.exports=function(t){var e=o.call(t),r=&quot;[object Arguments]&quot;===e;return r||(r=&quot;[object Array]&quot;!==e&amp;&amp;null!==t&amp;&amp;&quot;object&quot;==typeof t&amp;&amp;&quot;number&quot;==typeof t.length&amp;&amp;t.length&gt;=0&amp;&amp;&quot;[object Function]&quot;===o.call(t.callee)),r}},function(t,e,r){&quot;use strict&quot;;var o=r(5),n=r(14),i=r(15),a=r(34),l=i();o(l,{getPolyfill:i,implementation:n,shim:a}),t.exports=l},function(t,e,r){&quot;use strict&quot;;var o=r(15),n=r(5);t.exports=function(){var t=o();return n(Object,{entries:t},{entries:function(){return Object.entries!==t}}),t}},function(t,e,r){&quot;use strict&quot;;e.__esModule=!0;var o=r(19),n=r(0),i=r(1),a=r(4),l=r(17),s=r(18);o.API.autoTable=function(t,e,r){void 0===r&amp;&amp;(r={}),this.autoTableState=this.autoTableState||{},o.autoTableState=o.autoTableState||{};var c=[o.autoTableState.defaults||{},this.autoTableState.defaults||{},r||{}];s.validateInput(t,e,c);var u=n.Config.createTable(this);n.Config.initSettings(u,c);var f=u.settings;s.createModels(t,e),f.margin=n.Config.marginOrPadding(f.margin,n.getDefaults().margin),l.calculateWidths(this,n.Config.pageSize().width),u.cursor={x:u.margin(&quot;left&quot;),y:!1===f.startY?u.margin(&quot;top&quot;):f.startY};var p=f.startY+u.margin(&quot;bottom&quot;)+u.headerRow.height;&quot;avoid&quot;===f.pageBreak&amp;&amp;(p+=u.height);var y=n.Config.pageSize().height;(&quot;always&quot;===f.pageBreak&amp;&amp;!1!==f.startY||!1!==f.startY&amp;&amp;p&gt;y)&amp;&amp;(i.nextPage(u.doc),u.cursor.y=u.margin(&quot;top&quot;)),u.pageStartX=u.cursor.x,u.pageStartY=u.cursor.y,n.Config.applyUserStyles(),!0!==f.showHeader&amp;&amp;&quot;firstPage&quot;!==f.showHeader&amp;&amp;&quot;everyPage&quot;!==f.showHeader||a.printRow(u.headerRow,u.hooks.drawHeaderRow,u.hooks.drawHeaderCell),n.Config.applyUserStyles(),u.rows.forEach(function(t){a.printFullRow(t,u.hooks.drawRow,u.hooks.drawCell)}),i.addTableBorder();var h=this.internal.getCurrentPageInfo().pageNumber;return this.autoTableState.addPageHookPages&amp;&amp;this.autoTableState.addPageHookPages[h]?&quot;function&quot;==typeof r.addPageContent&amp;&amp;r.addPageContent(n.Config.hooksData()):(this.autoTableState.addPageHookPages||(this.autoTableState.addPageHookPages={}),this.autoTableState.addPageHookPages[h]=!0,i.addContentHooks()),u.finalY=u.cursor.y,this.autoTable.previous=u,n.Config.applyUserStyles(),this},o.API.autoTable.previous=!1,o.API.autoTableSetDefaults=function(t){return this.autoTableState||(this.autoTableState={}),t&amp;&amp;&quot;object&quot;==typeof t?this.autoTableState.defaults=t:delete this.autoTableState.defaults,this},o.autoTableSetDefaults=function(t){o.autoTableState||(o.autoTableState={}),t&amp;&amp;&quot;object&quot;==typeof t?this.autoTableState.defaults=t:delete this.autoTableState.defaults,o.autoTableState.defaults=t},o.API.autoTableHtmlToJson=function(t,e){if(e=e||!1,!(t&amp;&amp;t instanceof HTMLTableElement))return console.error(&quot;A HTMLTableElement has to be sent to autoTableHtmlToJson&quot;),null;for(var r={},o=[],n=t.rows[0],i=0;i&lt;n.cells.length;i++){var a=n.cells[i],l=window.getComputedStyle(a);(e||&quot;none&quot;!==l.display)&amp;&amp;(r[i]=a)}for(var i=1;i&lt;t.rows.length;i++)!function(n){var i=t.rows[n],a=window.getComputedStyle(i);if(e||&quot;none&quot;!==a.display){var l=[];Object.keys(r).forEach(function(t){var e=i.cells[t];l.push(e)}),o.push(l)}}(i);return{columns:Object.keys(r).map(function(t){return r[t]}),rows:o,data:o}},o.API.autoTableText=function(t,e,r,o){&quot;number&quot;==typeof e&amp;&amp;&quot;number&quot;==typeof r||console.error(&quot;The x and y parameters are required. Missing for the text: &quot;,t);var i=this.internal.scaleFactor,a=this.internal.getFontSize()/i,l=null,s=1;if(&quot;middle&quot;!==o.valign&amp;&amp;&quot;bottom&quot;!==o.valign&amp;&amp;&quot;center&quot;!==o.halign&amp;&amp;&quot;right&quot;!==o.halign||(l=&quot;string&quot;==typeof t?t.split(/\r\n|\r|\n/g):t,s=l.length||1),r+=a*(2-n.FONT_ROW_RATIO),&quot;middle&quot;===o.valign?r-=s/2*a*n.FONT_ROW_RATIO:&quot;bottom&quot;===o.valign&amp;&amp;(r-=s*a*n.FONT_ROW_RATIO),&quot;center&quot;===o.halign||&quot;right&quot;===o.halign){var c=a;if(&quot;center&quot;===o.halign&amp;&amp;(c*=.5),s&gt;=1){for(var u=0;u&lt;l.length;u++)this.text(l[u],e-this.getStringUnitWidth(l[u])*c,r),r+=a;return this}e-=this.getStringUnitWidth(t)*c}return this.text(t,e,r),this},o.API.autoTableEndPosY=function(){var t=this.autoTable.previous;return t.cursor&amp;&amp;&quot;number&quot;==typeof t.cursor.y?t.cursor.y:0},o.API.autoTableAddPageContent=function(t){return o.API.autoTable.globalDefaults||(o.API.autoTable.globalDefaults={}),o.API.autoTable.globalDefaults.addPageContent=t,this},o.API.autoTableAddPage=function(){return i.addPage(),this}}])});</td>
      </tr>
</table>

  </div>

</div>

<button type="button" data-facebox="#jump-to-line" data-facebox-class="linejump" data-hotkey="l" class="d-none">Jump to Line</button>
<div id="jump-to-line" style="display:none">
  <!-- '"` --><!-- </textarea></xmp> --></option></form><form accept-charset="UTF-8" action="" class="js-jump-to-line-form" method="get"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /></div>
    <input class="form-control linejump-input js-jump-to-line-field" type="text" placeholder="Jump to line&hellip;" aria-label="Jump to line" autofocus>
    <button type="submit" class="btn">Go</button>
</form></div>


  </div>
  <div class="modal-backdrop js-touch-events"></div>
</div>

    </div>
  </div>

  </div>

      
<div class="container site-footer-container">
  <div class="site-footer " role="contentinfo">
    <ul class="site-footer-links float-right">
        <li><a href="https://github.com/contact" data-ga-click="Footer, go to contact, text:contact">Contact GitHub</a></li>
      <li><a href="https://developer.github.com" data-ga-click="Footer, go to api, text:api">API</a></li>
      <li><a href="https://training.github.com" data-ga-click="Footer, go to training, text:training">Training</a></li>
      <li><a href="https://shop.github.com" data-ga-click="Footer, go to shop, text:shop">Shop</a></li>
        <li><a href="https://github.com/blog" data-ga-click="Footer, go to blog, text:blog">Blog</a></li>
        <li><a href="https://github.com/about" data-ga-click="Footer, go to about, text:about">About</a></li>

    </ul>

    <a href="https://github.com" aria-label="Homepage" class="site-footer-mark" title="GitHub">
      <svg aria-hidden="true" class="octicon octicon-mark-github" height="24" version="1.1" viewBox="0 0 16 16" width="24"><path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>
</a>
    <ul class="site-footer-links">
      <li>&copy; 2017 <span title="0.08786s from github-fe143-cp1-prd.iad.github.net">GitHub</span>, Inc.</li>
        <li><a href="https://github.com/site/terms" data-ga-click="Footer, go to terms, text:terms">Terms</a></li>
        <li><a href="https://github.com/site/privacy" data-ga-click="Footer, go to privacy, text:privacy">Privacy</a></li>
        <li><a href="https://github.com/security" data-ga-click="Footer, go to security, text:security">Security</a></li>
        <li><a href="https://status.github.com/" data-ga-click="Footer, go to status, text:status">Status</a></li>
        <li><a href="https://help.github.com" data-ga-click="Footer, go to help, text:help">Help</a></li>
    </ul>
  </div>
</div>



  <div id="ajax-error-message" class="ajax-error-message flash flash-error">
    <svg aria-hidden="true" class="octicon octicon-alert" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path fill-rule="evenodd" d="M8.865 1.52c-.18-.31-.51-.5-.87-.5s-.69.19-.87.5L.275 13.5c-.18.31-.18.69 0 1 .19.31.52.5.87.5h13.7c.36 0 .69-.19.86-.5.17-.31.18-.69.01-1L8.865 1.52zM8.995 13h-2v-2h2v2zm0-3h-2V6h2v4z"/></svg>
    <button type="button" class="flash-close js-flash-close js-ajax-error-dismiss" aria-label="Dismiss error">
      <svg aria-hidden="true" class="octicon octicon-x" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48z"/></svg>
    </button>
    You can't perform that action at this time.
  </div>


    
    <script crossorigin="anonymous" integrity="sha256-EjcFZu3GC0BKxFiWen8voNZpbamfN+333rEZbxr/Xwo=" src="https://assets-cdn.github.com/assets/frameworks-12370566edc60b404ac458967a7f2fa0d6696da99f37edf7deb1196f1aff5f0a.js"></script>
    <script async="async" crossorigin="anonymous" integrity="sha256-hMRPCrOL1keRE33pLi8bw7DGU0k0WPbrLrin8nqGbj4=" src="https://assets-cdn.github.com/assets/github-84c44f0ab38bd64791137de92e2f1bc3b0c653493458f6eb2eb8a7f27a866e3e.js"></script>
    
    
    
    
  <div class="js-stale-session-flash stale-session-flash flash flash-warn flash-banner d-none">
    <svg aria-hidden="true" class="octicon octicon-alert" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path fill-rule="evenodd" d="M8.865 1.52c-.18-.31-.51-.5-.87-.5s-.69.19-.87.5L.275 13.5c-.18.31-.18.69 0 1 .19.31.52.5.87.5h13.7c.36 0 .69-.19.86-.5.17-.31.18-.69.01-1L8.865 1.52zM8.995 13h-2v-2h2v2zm0-3h-2V6h2v4z"/></svg>
    <span class="signed-in-tab-flash">You signed in with another tab or window. <a href="">Reload</a> to refresh your session.</span>
    <span class="signed-out-tab-flash">You signed out in another tab or window. <a href="">Reload</a> to refresh your session.</span>
  </div>
  <div class="facebox" id="facebox" style="display:none;">
  <div class="facebox-popup">
    <div class="facebox-content" role="dialog" aria-labelledby="facebox-header" aria-describedby="facebox-description">
    </div>
    <button type="button" class="facebox-close js-facebox-close" aria-label="Close modal">
      <svg aria-hidden="true" class="octicon octicon-x" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48z"/></svg>
    </button>
  </div>
</div>


  </body>
</html>

