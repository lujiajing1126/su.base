# 站点框架说明

## 条件

框架需要：

	bash
	coreutils
	make
	php (>= 5.4)
	rsync
	wget
	xz
	TODO

方能使用。

Windows 用户需要特别注意，php 是这些软件中唯一不能通过 Cygwin 安装的。从官方网站下载 php 后，你可以自行选择解压缩到任何位置，但是执行 testing-server 前须保证 php 文件夹路径记录于 PATH 环境变量中。

## 开始使用

执行：

	make config

这时你会得到 `config` 文件，根据你的需要修改它。

修改完毕，执行：

	make siteroot

这时你会得到两个文件夹：`modules`、`siteroot`

运行：

	./testing-server

在浏览器里打开 <http://localhost:8000/> 即可看到网站。

应注意经常检查 `base.git` 的更新，每次更新后都调用 `make update-data`

## 文件说明

### config

TODO

### siteroot

网站的数据目录。在调用 `make update-siteroot` 后自动生成。

其中将会包括至少三个子目录： `网站名.doc`, `网站名.prog`, `网站名.var`, `网站名.conf`。这三个文件夹分别由 `模块/site.doc`, `模块/site.prog`, `模块/site.var` , `模块/site.conf` 拼合而成。脚本会安装 `modules/` 下的所有模块, 以及 `base` 模块。

其中 `网站名.doc` 对应于网站的文档根，它包含文档不应被修改、能够被网站访问者直接浏览，它们构成网站内容； `网站名.prog` 包含不应被修改、不应被访问者浏览的文件（比如服务端的函数库、尚未渲染的页面模版），它们的作用是为网站程序提供支持； `网站名.var` 包含需要被修改但不应被浏览的文件，比如数据文件； `网站名.conf` 与 `网站名.prog` 功能相同，但是不会被 `make update-siteroot` 自动更新，用于储存默认的配置文件。

其中“网站名”为 `config` 文件中的 `SITENAME`。

### modules & base

`modules` 文件夹中的每个文件夹都是一个模块；而 `base` 文件夹自身是一个模块。

每个模块的结构如下：

	module-directory/
	  |
	  |- Makefile (可选)
	  |- site.doc/ (可选)
	     |- rsync-filter (可选)
	  |- site.prog/ (可选)
	     |- rsync-filter (可选)
	  |- site.var/ (可选)
	     |- rsync-filter (可选)
	  |- site.conf/ (可选)
	     |- rsync-filter (可选)

其中 `rsync-filter` 为 `rsync` 读取的过滤器，它们可由 `Makefile` 生成；除了每个模块自定义的过滤器以外，所有文件都会被 `dev/general-rsync-filter` 过滤。

`Makefile` 应当至少提供两个目标：`deployment`、`development`，分别用于部署和调试时的网站构造。

### Makefile

调用：

	make update-data

将会获取或更新三个系统模块：`conf`、`data`、`lib`。它们是根据 `config` 文件中 `DEVURL` 所给出的地址被自动下载的。这三个模块会不时更新，应当注意经常更新，特别是当 `base.git` 自身更新过后。

他们的源文件将下载到 `modules/conf.tar.xz`、 `modules/data.tar.xz`、 `modules/lib.tar.xz`；释放到 `modules/conf`、  `modules/data`、 `modules/lib`。调用 `make update-data` 后原有的 `data`、 `lib` 模块将被替换，而 `conf` 则不会。

调用：

	make siteroot

会生成 `siteroot` 文件夹，它是通过安装 `base` 模块和 `modules` 下所有模块形成的。

当 `modules/` 内容修改过后，可以调用：

	make update-siteroot # 以正式部署 (deployment) 模式更新 siteroot

或者：

	make update-siteroot-testing # 以测试 (testing) 模式更新 siteroot

正式部署模式下，所有 `TEST` 开头的文件都不会被部署（参看 `dev/rsync-filter-for-deployment`）。

更新 `siteroot` 文件夹。

### testing-server

默认参数运行后可在浏览器中打开 <http://localhost:8000/> 看到 `siteroot/网站名.doc` 下的页面。

TODO

## 环境

所有此框架下的 php 页面都可使用 `$_SITE` 变量，具体含义参看 `base/site.prog/siteconf.php`。

## 故障排除

### \r 问题

TODO
