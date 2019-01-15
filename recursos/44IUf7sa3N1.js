if (self.CavalryLogger) { CavalryLogger.start_js(["VcKdc"]); }

__d("PresenceViewerCapabilities",["ArbiterMixin","Bootloader","CurrentUser","PresenceConfig","debounceAcrossTransitions"],(function(a,b,c,d,e,f){"use strict";__p&&__p();var g=null,h=Object.assign({},b("ArbiterMixin")),i=b("debounceAcrossTransitions")(function(){return h.inform("viewerChange")},0);function j(a){try{a=JSON.parse(a.payload);a.capabilityBitMask!==g&&i();a.capabilityBitMask!=null&&(g=a.capabilityBitMask)}catch(a){}}Object.assign(h,{get:function(){if(g!=null)return g;b("Bootloader").loadModules(["SkywalkerManager"],function(a){return a.subscribe("presence/fb/"+b("CurrentUser").getID(),j)},"PresenceViewerCapabilities");g=b("PresenceConfig").get("viewer_presence_capabilities");return g}});e.exports=h}),null);
__d("QuickPerformanceLogger",["requireCond","cr:684019"],(function(a,b,c,d,e,f){"use strict";e.exports=b("cr:684019")}),null);
__d("RelayQuickLogModule",[],(function(a,b,c,d,e,f){e.exports=Object.freeze({GROUPS_INIT_FETCH_TIME:7995393,LOAD_ALL_PROJECTS_AIP:7995408,NETWORK_FETCH_QUERY:7995401,NETWORK_FETCH_QUERY_NATIVE:7995405,PREFETCHER_FETCH_QUERY:7995395,RELAY_PLAYGROUND_TTI:7995394,RESPONSE_NORMALIZER_NORMALIZE:7995404,RESPONSE_NORMALIZER_NORMALIZE_NATIVE:7995406,RUNTIME_GC:7995402,RUNTIME_GC_NATIVE:7995407,RUNTIME_NOTIFY:7995403,RUNTIME_SUBSCRIPTIONS:7995400,UNSAFE_ASYNC_TEST:7995399,UNSAFE_SUBSCRIPTIONS_TEST:7995396,UNSAFE_SYNC_TEST:7995398,UNSAFE_TESTING_NATIVE:7995397})}),null);
__d("RelayUniversalLogger",["QuickPerformanceLogger","RelayQuickLogModule","emptyFunction","warning"],(function(a,b,c,d,e,f){"use strict";__p&&__p();function a(a,c){b("QuickPerformanceLogger").markerStart(b("RelayQuickLogModule").RUNTIME_SUBSCRIPTIONS),c(),b("QuickPerformanceLogger").markerEnd(b("RelayQuickLogModule").RUNTIME_SUBSCRIPTIONS,"SUCCESS")}var g=0;function c(a,c){__p&&__p();if(!c){b("warning")(!1,"RelayFBUniversalLogger: State missing");return b("emptyFunction")}var d=c;g+=1;var e=g;b("QuickPerformanceLogger").markerStart(b("RelayQuickLogModule").NETWORK_FETCH_QUERY,e);return function(a){var c=d.queryName,f=d.usedCache,g=d.usedPrefetcher;c&&b("QuickPerformanceLogger").annotateMarkerString(b("RelayQuickLogModule").NETWORK_FETCH_QUERY,"QUERY_NAME",c,e);typeof f==="boolean"&&b("QuickPerformanceLogger").annotateMarkerInt(b("RelayQuickLogModule").NETWORK_FETCH_QUERY,"USED_CACHE",f?1:0,e);typeof g==="boolean"&&b("QuickPerformanceLogger").annotateMarkerInt(b("RelayQuickLogModule").NETWORK_FETCH_QUERY,"USED_PREFETCHER",g?1:0,e);a&&b("QuickPerformanceLogger").annotateMarkerString(b("RelayQuickLogModule").NETWORK_FETCH_QUERY,"ERROR",a.message,e);b("QuickPerformanceLogger").markerEnd(b("RelayQuickLogModule").NETWORK_FETCH_QUERY,a?"FAIL":"SUCCESS",e)}}function d(a,c){b("QuickPerformanceLogger").markerStart(b("RelayQuickLogModule").RUNTIME_GC),c(),b("QuickPerformanceLogger").markerEnd(b("RelayQuickLogModule").RUNTIME_GC,"SUCCESS")}function f(a,c){b("QuickPerformanceLogger").markerStart(b("RelayQuickLogModule").RESPONSE_NORMALIZER_NORMALIZE),c(),b("QuickPerformanceLogger").markerEnd(b("RelayQuickLogModule").RESPONSE_NORMALIZER_NORMALIZE,"SUCCESS")}e.exports={gcAggregateHandler:d,startProfileFetchRelayQueryHandler:c,responseNormalizerAggregateHandler:f,subscriptionAggregateHandler:a}}),null);
__d("installRelayUniversalLogger",["RelayRuntime","RelayUniversalLogger"],(function(a,b,c,d,e,f){"use strict";var g=b("RelayRuntime").RelayProfiler,h=b("RelayUniversalLogger").gcAggregateHandler,i=b("RelayUniversalLogger").responseNormalizerAggregateHandler,j=b("RelayUniversalLogger").startProfileFetchRelayQueryHandler,k=b("RelayUniversalLogger").subscriptionAggregateHandler;function a(){g.attachAggregateHandler("RelayMarkSweepStore.prototype.subscribe",k),g.attachProfileHandler("fetchRelayQuery",j),g.attachAggregateHandler("RelayMarkSweepStore.prototype.__gc",h),g.attachAggregateHandler("RelayResponseNormalizer.normalize",i)}e.exports=a}),null);
__d("MosUtils",[],(function(a,b,c,d,e,f){"use strict";__p&&__p();var g={getQualityLabel:function(a,b){if(a===0||b===0)return 0;if(a<b){var c=a;a=b;b=c}c=a/b;return c>16/9?Math.round(a/(16/9)):b},getMosValue:function(a,b){__p&&__p();var c=null,d=null,e=null,f=null;for(var g=0;g<a.length;g++){var h=a[g].qualityLabel;if(h<=b)e=a[g].mosValue,c=h;else{f=a[g].mosValue;d=h;break}}if(c===null&&d===null)return 0;else if(c===null&&f!==null)return f;else if(d===null&&e!==null)return e;else if(f!==null&&e!==null&&c!==null&&d!==null){h=e+(b-c)*(f-e)/(d-c);return h<0?0:h>100?100:h}return 0},parsePlaybackMos:function(a){__p&&__p();a=a.split(",");var b=[];for(var c=0;c<a.length;c++){var d=a[c].split(":");if(d.length!==2)return null;var e=Number(d[0]);d=Number(d[1]);if(isNaN(e)||isNaN(d))return null;b.push({qualityLabel:e,mosValue:d})}return b},filterTracksWithExpensiveMos:function(a,b,c,d,e,f){__p&&__p();if(a.length<2)return a;var h=a.map(function(a){return{track:a,mosValue:a.playbackResolutionMos?g.getMosValue(a.playbackResolutionMos,g.getQualityLabel(b,c)):-1}}),i=[],j=e;for(var k=h.length-1;k>0;k--){if(h[k].mosValue===-1||h[k-1].mosValue===-1)return a;var l=h[k].track.bandwidth||-1,m=h[k-1].track.bandwidth||-1;if(l===-1||m===-1)return a;if(h[k].mosValue<h[k-1].mosValue&&l>=m)continue;l=h[k-1].track.bandwidth!==null?h[k].mosValue-h[k-1].mosValue:Infinity;if(l<=j&&h[k].track.bandwidth&&d/h[k].track.bandwidth<=f){j-=l;continue}else j=e;i.push(h[k].track)}i.push(h[0].track);i.reverse();return i}};e.exports=g}),null);
__d("XGraphQLBatchAPIController",["XController"],(function(a,b,c,d,e,f){e.exports=b("XController").create("/api/graphqlbatch/",{queries:{type:"String"},batch_name:{type:"String"},scheduler:{type:"Enum",enumType:1},shared_params:{type:"String"},fb_api_req_friendly_name:{type:"String"},uft_request_id:{type:"String"}})}),null);
__d("WebGraphQL",["ActorURI","AsyncRequest","Deferred","FBLogger","WebGraphQLConfig","XGraphQLBatchAPIController","getAsyncParams","gkx"],(function(a,b,c,d,e,f){"use strict";__p&&__p();function g(a){__p&&__p();var c=a.getURIBuilder().getURI(),d={exec:function(a,b){return d.execAll([a],b)[0]},execAll:function(a,d){__p&&__p();var e={},f={};a=a.map(function(a,c){c="o"+c;e[c]={doc_id:a.__getDocID(),query_params:a.__getVariables()};a=new(b("Deferred"))();f[c]=a;return a.getPromise()});var g=babelHelpers["extends"]({},b("getAsyncParams")("POST"));d&&d.actorID!=null&&(g[b("ActorURI").PARAMETER_ACTOR]=d.actorID);var h=d&&d.batchName?{batch_name:d.batchName}:{};h=new(b("AsyncRequest"))().setURI(c).setOption("suppressEvaluation",!0).setMethod("POST").setRequestHeader("Content-Type","application/x-www-form-urlencoded").setData(babelHelpers["extends"]({},h,g,{queries:JSON.stringify(e)})).setHandler(function(a){__p&&__p();a=a.getPayload();try{var c=a.response.split("\r\n");c.pop();c=c.map(function(a){return JSON.parse(a)});c.forEach(function(a){return Object.keys(a).forEach(function(b){var c=f[b];if(c){b=a[b];b.errors?c.reject(b):b.data?c.resolve(b.data):c.reject({data:{},errors:[{message:"Unexpected response received from server.",severity:"CRITICAL",response:b}]})}})})}catch(d){c=a.response;b("FBLogger")("webgraphql").catching(d).mustfix("Bad response: ","%s%s",c.substr(0,250),c.length>250?"[truncated]":"")}Object.keys(f).forEach(function(a){f[a].isSettled()||f[a].reject({data:{},errors:[{message:"No response received from server.",severity:"CRITICAL"}]})})}).setTimeoutHandler(b("WebGraphQLConfig").timeout,function(){Object.keys(f).forEach(function(a){f[a].isSettled()||f[a].reject({data:{},errors:[{message:"Request timed out.",severity:"CRITICAL"}]})})}).setErrorHandler(function(a){var b=a.getErrorDescription();Object.keys(f).forEach(function(c){f[c].isSettled()||f[c].reject({data:{},errors:[{message:b,severity:"CRITICAL",error:a.getError()}]})})});d&&d.msgrRegion&&h.setRequestHeader("X-MSGR-Region",d.msgrRegion);b("gkx")("801901")?h.setAllowCrossPageTransition(!0):d&&d.allowCrossPageTransition!=null&&h.setAllowCrossPageTransition(d.allowCrossPageTransition);h.send();return a},__forController:g};return d}e.exports=g(b("XGraphQLBatchAPIController"))}),null);
__d("WorkplaceChatHelper",["ChannelConstants","CurrentUser","PresenceViewerCapabilities"],(function(a,b,c,d,e,f){"use strict";a={isDesktopChatApp:function(){return window.workchat!==void 0},getAppID:function(){return window.workchat.appId},showWindow:function(){window.workchat.showWindow()},getScreenSharingSourceID:function(){return window.workchat.getScreenSharingSourceID()},stopScreenSharing:function(){return window.workchat.stopScreenSharing()},suppressChatIfActiveOnDesktop:function(){return b("CurrentUser").isWorkUser()&&(b("PresenceViewerCapabilities").get()&b("ChannelConstants").CAPABILITY_ACTIVE_ON_DESKTOP_APP)==b("ChannelConstants").CAPABILITY_ACTIVE_ON_DESKTOP_APP}};e.exports=a}),null);
__d("DOMContainer.react",["invariant","React","ReactDOM","isNode"],(function(a,b,c,d,e,f,g){__p&&__p();var h;c=b("React").PropTypes;h=babelHelpers.inherits(a,b("React").Component);h&&h.prototype;a.prototype.getDOMChild=function(){"use strict";var a=this.props.children;b("isNode")(a)||g(0,1533);return a};a.prototype.shouldComponentUpdate=function(a){"use strict";return a.children!==this.props.children};a.prototype.componentDidMount=function(){"use strict";var a=b("ReactDOM").findDOMNode(this);a!=null&&a.appendChild(this.getDOMChild())};a.prototype.componentDidUpdate=function(){"use strict";var a=b("ReactDOM").findDOMNode(this);if(a==null)return;while(a.lastChild)a.removeChild(a.lastChild);a.appendChild(this.getDOMChild())};a.prototype.render=function(){"use strict";var a=this.props,c=a.display,d=a.containerRef;a=babelHelpers.objectWithoutPropertiesLoose(a,["display","containerRef"]);return c==="block"?b("React").createElement("div",babelHelpers["extends"]({},a,{ref:d}),void 0):b("React").createElement("span",babelHelpers["extends"]({},a,{ref:d}),void 0)};function a(){"use strict";h.apply(this,arguments)}a.propTypes={display:c.oneOf(["inline","block"]),containerRef:c.func};a.defaultProps={display:"inline"};e.exports=a}),null);
__d("LineClamp.react",["cx","DOMContainer.react","Locale","React","ReactDOM","getElementText","getVendorPrefixedName","joinClasses"],(function(a,b,c,d,e,f,g){"use strict";__p&&__p();var h,i=b("getVendorPrefixedName")("lineClamp");c=babelHelpers.inherits(a,b("React").Component);h=c&&c.prototype;function a(){var a,c;for(var d=arguments.length,e=new Array(d),f=0;f<d;f++)e[f]=arguments[f];return c=(a=h.constructor).call.apply(a,[this].concat(e)),this.state={enableTooltip:!1},this.$2=function(a){a=b("ReactDOM").findDOMNode(a);a instanceof HTMLElement&&(this.innerElement=a,this.$3())}.bind(this),this.$4=function(a){a=b("ReactDOM").findDOMNode(a);a instanceof HTMLElement&&(this.rootElement=a,this.$3())}.bind(this),c}a.prototype.$1=function(){var a;this.props.lineHeight&&!this.props.customEllipsisDisableGradient&&(a={bottom:this.props.lineHeight+"px"});var c;this.props.customEllipsis&&this.props.customEllipsisDisableGradient?c=b("Locale").isRTL()?"_1osp":"_1osq":c=b("Locale").isRTL()?"_4ik3 _2k5c":"_4ik3"+(this.props.enableCustomizedStyleForEllipsis?" _6q5n":"")+(this.props.enableCustomizedStyleForEllipsis?"":" _2k5d");return b("React").createElement("div",{style:a,className:c,key:"ellipsis"},this.props.customEllipsis?this.props.customEllipsis:"\u2026")};a.prototype.$3=function(){__p&&__p();if(!this.props.enableTooltipOnOverflow)return;if(!this.rootElement)return;var a=this.rootElement,b;if(this.$5())b=a.scrollHeight>a.offsetHeight;else{if(!this.innerElement)return;b=this.innerElement.offsetHeight>a.offsetHeight}this.state.enableTooltip!==b&&this.setState({enableTooltip:b})};a.prototype.$5=function(){return!!i&&!this.props.disableNative};a.prototype.componentDidMount=function(){this.$3()};a.prototype.componentDidUpdate=function(){this.$3()};a.prototype.render=function(){var a=this.$5(),c=b("joinClasses")(this.props.className,"_4ik4"+(a?" _4ik5":"")),d=this.props.hasXHPChildren?b("React").createElement(b("DOMContainer.react"),null,this.props.children):this.props.children,e={};this.props.lineHeight&&(e={lineHeight:this.props.lineHeight+"px"},this.props.fitHeightToShorterText?e=babelHelpers["extends"]({},e,{maxHeight:this.props.lineHeight*this.props.lines}):e=babelHelpers["extends"]({},e,{height:this.props.lineHeight*this.props.lines}));a?e[i]=this.props.lines:(c=b("joinClasses")(c,"clearfix"),this.props.customEllipsisDisableGradient?d=[b("React").createElement("div",{className:"_1osu",key:"spacer"}),this.$1(),b("React").createElement("div",{className:"_1osv",key:"inner",ref:this.$2},this.props.children)]:d=[b("React").createElement("div",{className:"_4ik6",key:"inner",ref:this.$2},d),this.$1()]);var f={};this.props.enableTooltipOnOverflow&&(f["data-hover"]="tooltip",this.state.enableTooltip&&(f["data-tooltip-content"]=a?b("getElementText")(this.rootElement):b("getElementText")(this.innerElement),this.props.tooltipDelay!=null&&(f["data-tooltip-delay"]=this.props.tooltipDelay)));return b("React").createElement("div",babelHelpers["extends"]({},f,{className:c,ref:this.$4,style:e}),d)};e.exports=a}),null);
__d("BootloaderResource",[],(function(a,b,c,d,e,f){a={preload:function(a){a.load()},read:function(b){var a=b.getModuleIfRequired();if(!a)throw b.load();return a}};e.exports=a}),null);
__d("Network",["mixInEventEmitter"],(function(a,b,c,d,e,f){__p&&__p();var g=!0,h=a.navigator.connection,i={0:"unknown",1:"ethernet",2:"wifi",3:"2g",4:"3g"};function c(){return g}function d(a){if(a==g)return;g=a;l.emit(a?"online":"offline")}function f(){return h?h.bandwidth:g?Infinity:0}function j(){return h?h.metered:!1}function k(){var a=h?String(h.type):"0";return i[a]||a}var l={getBandwidth:f,getType:k,isMetered:j,isOnline:c,setOnline:d};b("mixInEventEmitter")(l,{online:!0,offline:!0});l=l;a.addEventListener?(a.addEventListener("online",d.bind(null,!0)),a.addEventListener("offline",d.bind(null,!1))):a.attachEvent&&(a.attachEvent("online",d.bind(null,!0)),a.attachEvent("offline",d.bind(null,!1)));e.exports=l}),null);
__d("fbjs/lib/CSSCore",["CSSCore"],(function(a,b,c,d,e,f){"use strict";e.exports=b("CSSCore")}),null);
__d("ReactCSSTransitionGroupChild",["React","ReactDOM","ReactTransitionEvents","fbjs/lib/CSSCore"],(function(a,b,c,d,e,f){"use strict";__p&&__p();var g=17;a=b("React").createClass({displayName:"ReactCSSTransitionGroupChild",propTypes:{name:b("React").PropTypes.oneOfType([b("React").PropTypes.string,b("React").PropTypes.shape({enter:b("React").PropTypes.string,leave:b("React").PropTypes.string,active:b("React").PropTypes.string}),b("React").PropTypes.shape({enter:b("React").PropTypes.string,enterActive:b("React").PropTypes.string,leave:b("React").PropTypes.string,leaveActive:b("React").PropTypes.string,appear:b("React").PropTypes.string,appearActive:b("React").PropTypes.string})]).isRequired,appear:b("React").PropTypes.bool,enter:b("React").PropTypes.bool,leave:b("React").PropTypes.bool,appearTimeout:b("React").PropTypes.number,enterTimeout:b("React").PropTypes.number,leaveTimeout:b("React").PropTypes.number},transition:function(a,c,d){__p&&__p();var e=b("ReactDOM").findDOMNode(this);if(!e){c&&c();return}var f=this.props.name[a]||this.props.name+"-"+a,g=this.props.name[a+"Active"]||f+"-active",h=null;a=function a(d){if(d&&d.target!==e)return;clearTimeout(h);b("fbjs/lib/CSSCore").removeClass(e,f);b("fbjs/lib/CSSCore").removeClass(e,g);b("ReactTransitionEvents").removeEndEventListener(e,a);c&&c()};b("fbjs/lib/CSSCore").addClass(e,f);this.queueClassAndNode(g,e);d?(h=setTimeout(a,d),this.transitionTimeouts.push(h)):b("ReactTransitionEvents").addEndEventListener(e,a)},queueClassAndNode:function(a,b){this.classNameAndNodeQueue.push({className:a,node:b}),this.timeout||(this.timeout=setTimeout(this.flushClassNameAndNodeQueue,g))},flushClassNameAndNodeQueue:function(){this.isMounted()&&this.classNameAndNodeQueue.forEach(function(a){b("fbjs/lib/CSSCore").addClass(a.node,a.className)}),this.classNameAndNodeQueue.length=0,this.timeout=null},UNSAFE_componentWillMount:function(){this.classNameAndNodeQueue=[],this.transitionTimeouts=[]},componentWillUnmount:function(){this.timeout&&clearTimeout(this.timeout),this.transitionTimeouts.forEach(function(a){clearTimeout(a)}),this.classNameAndNodeQueue.length=0},componentWillAppear:function(a){this.props.appear?this.transition("appear",a,this.props.appearTimeout):a()},componentWillEnter:function(a){this.props.enter?this.transition("enter",a,this.props.enterTimeout):a()},componentWillLeave:function(a){this.props.leave?this.transition("leave",a,this.props.leaveTimeout):a()},render:function(){return b("React").Children.only(this.props.children)}});e.exports=a}),null);
__d("ReactTransitionChildMapping",["React","emptyFunction","warning"],(function(a,b,c,d,e,f){"use strict";__p&&__p();a=b("emptyFunction");c={getChildMapping:function(a){if(!a)return a;var c={};b("React").Children.toArray(a).forEach(function(a){var b=a.key,d=c[b]===void 0;d&&(c[b]=a)});return c},mergeChildMappings:function(a,b){__p&&__p();a=a||{};b=b||{};function c(c){if(Object.prototype.hasOwnProperty.call(b,c))return b[c];else return a[c]}var d={},e=[];for(var f in a)Object.prototype.hasOwnProperty.call(b,f)?e.length&&(d[f]=e,e=[]):e.push(f);var g,h={};for(var i in b){if(Object.prototype.hasOwnProperty.call(d,i))for(g=0;g<d[i].length;g++){var j=d[i][g];h[d[i][g]]=c(j)}h[i]=c(i)}for(g=0;g<e.length;g++)h[e[g]]=c(e[g]);return h}};e.exports=c}),null);
__d("ReactTransitionGroup",["React","ReactTransitionChildMapping","fbjs/lib/emptyFunction"],(function(a,b,c,d,e,f){"use strict";__p&&__p();var g;c=babelHelpers.inherits(a,b("React").Component);g=c&&c.prototype;function a(){__p&&__p();var a,c;for(var d=arguments.length,e=new Array(d),f=0;f<d;f++)e[f]=arguments[f];return c=(a=g.constructor).call.apply(a,[this].concat(e)),this.state={children:b("ReactTransitionChildMapping").getChildMapping(this.props.children)},this.performAppear=function(a){this.currentlyTransitioningKeys[a]=!0;var b=this.refs[a];b.componentWillAppear?b.componentWillAppear(this.$1.bind(this,a)):this.$1(a)}.bind(this),this.$1=function(a){var c=this.refs[a];c.componentDidAppear&&c.componentDidAppear();delete this.currentlyTransitioningKeys[a];c=b("ReactTransitionChildMapping").getChildMapping(this.props.children);(!c||!Object.prototype.hasOwnProperty.call(c,a))&&this.performLeave(a)}.bind(this),this.performEnter=function(a){this.currentlyTransitioningKeys[a]=!0;var b=this.refs[a];b.componentWillEnter?b.componentWillEnter(this.$2.bind(this,a)):this.$2(a)}.bind(this),this.$2=function(a){var c=this.refs[a];c.componentDidEnter&&c.componentDidEnter();delete this.currentlyTransitioningKeys[a];c=b("ReactTransitionChildMapping").getChildMapping(this.props.children);(!c||!Object.prototype.hasOwnProperty.call(c,a))&&this.performLeave(a)}.bind(this),this.performLeave=function(a){this.currentlyTransitioningKeys[a]=!0;var b=this.refs[a];b.componentWillLeave?b.componentWillLeave(this.$3.bind(this,a)):this.$3(a)}.bind(this),this.$3=function(a){var c=this.refs[a];c.componentDidLeave&&c.componentDidLeave();delete this.currentlyTransitioningKeys[a];c=b("ReactTransitionChildMapping").getChildMapping(this.props.children);c&&Object.prototype.hasOwnProperty.call(c,a)?this.performEnter(a):this.setState(function(b){b=Object.assign({},b.children);delete b[a];return{children:b}})}.bind(this),c}a.prototype.UNSAFE_componentWillMount=function(){this.currentlyTransitioningKeys={},this.keysToEnter=[],this.keysToLeave=[]};a.prototype.componentDidMount=function(){var a=this.state.children;for(var b in a)a[b]&&this.performAppear(b)};a.prototype.UNSAFE_componentWillReceiveProps=function(a){__p&&__p();a=b("ReactTransitionChildMapping").getChildMapping(a.children);var c=this.state.children;this.setState({children:b("ReactTransitionChildMapping").mergeChildMappings(c,a)});var d;for(d in a){var e=c&&Object.prototype.hasOwnProperty.call(c,d);a[d]&&!e&&!this.currentlyTransitioningKeys[d]&&this.keysToEnter.push(d)}for(d in c){e=a&&Object.prototype.hasOwnProperty.call(a,d);c[d]&&!e&&!this.currentlyTransitioningKeys[d]&&this.keysToLeave.push(d)}};a.prototype.componentDidUpdate=function(){var a=this.keysToEnter;this.keysToEnter=[];a.forEach(this.performEnter);a=this.keysToLeave;this.keysToLeave=[];a.forEach(this.performLeave)};a.prototype.render=function(){__p&&__p();var a=[];for(var c in this.state.children){var d=this.state.children[c];d&&a.push(b("React").cloneElement(this.props.childFactory(d),{ref:c,key:c}))}d=Object.assign({},this.props);delete d.transitionLeave;delete d.transitionName;delete d.transitionAppear;delete d.transitionEnter;delete d.childFactory;delete d.transitionLeaveTimeout;delete d.transitionEnterTimeout;delete d.transitionAppearTimeout;delete d.component;return b("React").createElement(this.props.component,d,a)};a.displayName="ReactTransitionGroup";a.propTypes={component:b("React").PropTypes.any,childFactory:b("React").PropTypes.func};a.defaultProps={component:"span",childFactory:b("fbjs/lib/emptyFunction").thatReturnsArgument};e.exports=a}),null);
__d("ReactCSSTransitionGroup",["React","ReactCSSTransitionGroupChild","ReactTransitionGroup"],(function(a,b,c,d,e,f){"use strict";__p&&__p();var g;function a(a){var b="transition"+a+"Timeout",c="transition"+a;return function(a){if(a[c])if(a[b]==null)return new Error(b+" wasn't supplied to ReactCSSTransitionGroup: this can cause unreliable animations and won't be supported in a future version of React. See https://fb.me/react-animation-transition-group-timeout for more information.");else if(typeof a[b]!=="number")return new Error(b+" must be a number (in milliseconds)")}}d=babelHelpers.inherits(c,b("React").Component);g=d&&d.prototype;function c(){var a,c;for(var d=arguments.length,e=new Array(d),f=0;f<d;f++)e[f]=arguments[f];return c=(a=g.constructor).call.apply(a,[this].concat(e)),this.$1=function(a){return b("React").createElement(b("ReactCSSTransitionGroupChild"),{name:this.props.transitionName,appear:this.props.transitionAppear,enter:this.props.transitionEnter,leave:this.props.transitionLeave,appearTimeout:this.props.transitionAppearTimeout,enterTimeout:this.props.transitionEnterTimeout,leaveTimeout:this.props.transitionLeaveTimeout},a)}.bind(this),c}c.prototype.render=function(){return b("React").createElement(b("ReactTransitionGroup"),Object.assign({},this.props,{childFactory:this.$1}))};c.displayName="ReactCSSTransitionGroup";c.propTypes={transitionName:b("ReactCSSTransitionGroupChild").propTypes.name,transitionAppear:b("React").PropTypes.bool,transitionEnter:b("React").PropTypes.bool,transitionLeave:b("React").PropTypes.bool,transitionAppearTimeout:a("Appear"),transitionEnterTimeout:a("Enter"),transitionLeaveTimeout:a("Leave")};c.defaultProps={transitionAppear:!1,transitionEnter:!0,transitionLeave:!0};e.exports=c}),null);
__d("Placeholder.react",["react"],(function(a,b,c,d,e,f){var g=b("react").Suspense;function a(a){var c=a.fallback;return b("react").createElement(g,babelHelpers["extends"]({},a,{fallback:c===void 0?null:c}))}e.exports=a}),null);
__d("lazyLoadComponent",["BootloaderResource","react"],(function(a,b,c,d,e,f){function a(a){function c(c){var d=b("BootloaderResource").read(a);return b("react").createElement(d,c)}c.displayName="lazyLoadComponent("+a.getModuleId()+")";return c}e.exports=a}),null);
__d("WebGraphQLLegacyHelper",["invariant"],(function(a,b,c,d,e,f,g){"use strict";e.exports={getURI:function(a){var b=a.controller,c=a.docID,d=a.queryID;a=a.variables;c!=d&&(c||d)!=null||g(0,5819,c,d);b=b.getURIBuilder();d?b.setFBID("query_id",d):b.setFBID("doc_id",c);a&&b.setString("variables",JSON.stringify(a));return b.getURI()}}}),null);
__d("XWebGraphQLQueryController",["XController"],(function(a,b,c,d,e,f){e.exports=b("XController").create("/webgraphql/query/",{query_id:{type:"FBID"},variables:{type:"String"},doc_id:{type:"FBID"}})}),null);
__d("WebGraphQLQueryBase",["invariant","WebGraphQLLegacyHelper","XWebGraphQLQueryController"],(function(a,b,c,d,e,f,g){"use strict";__p&&__p();function a(a){this.$1=a}a.prototype.__getVariables=function(){return this.$1};a.prototype.__getDocID=function(){return this.constructor.__getDocID()};a.__getController=function(){return b("XWebGraphQLQueryController")};a.__getDocID=function(){g(0,1804)};a.getURI=function(a){return b("WebGraphQLLegacyHelper").getURI({controller:this.__getController(),docID:this.__getDocID(),variables:a})};a.getLegacyURI=function(a){return b("WebGraphQLLegacyHelper").getURI({controller:this.__getController(),queryID:this.getQueryID(),variables:a})};a.getQueryID=function(){g(0,5095)};e.exports=a}),null);
__d("cssVar",[],(function(a,b,c,d,e,f){function a(a){throw new Error('cssVar("'+a+'"): Unexpected class transformation.')}e.exports=a}),null);