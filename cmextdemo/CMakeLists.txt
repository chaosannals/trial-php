cmake_minimum_required(VERSION 3.24)

include(FetchContent)

project(cmextdemo)

## 网络问题，克隆失败多试几次。

FetchContent_Declare(
  phpsrc
  GIT_REPOSITORY git@github.com:php/php-src.git
  GIT_TAG php-8.2.3
)
FetchContent_Populate(phpsrc)

set(PHPSRC_EXT_DIR "${phpsrc_SOURCE_DIR}/ext")
set(PHPEXT_DIR "${CMAKE_CURRENT_SOURCE_DIR}/phpext")
set(PHPEXT_TO_DIR "${PHPSRC_EXT_DIR}/phpext")

message(STATUS "copy myext dir: ${PHPEXT_DIR} => ${PHPEXT_TO_DIR}")

execute_process(
	# COMMAND ${CMAKE_COMMAND} -E remove "${PHPEXT_TO_DIR}"
	COMMAND ${CMAKE_COMMAND} -E copy_directory "${PHPEXT_DIR}" "${PHPEXT_TO_DIR}"
	# COMMENT "copy myext dir: ${PHPEXT_DIR} => ${PHPEXT_TO_DIR}"
)

# 定义扩展TARGET
add_custom_target(
	phpext
	COMMAND ${CMAKE_COMMAND} -E copy_directory "${PHPEXT_DIR}" "${PHPEXT_TO_DIR}"
)

# 扩展文件复制到 ext 目录
add_custom_command(
	TARGET phpext
	COMMAND ${CMAKE_COMMAND} -E copy_directory "${PHPEXT_DIR}" "${PHPEXT_TO_DIR}"
)

if (WIN32 AND MSVC)
	message(STATUS "make in MSVC")

	# 获取 PHP-SDK
	FetchContent_Declare(
		phpsdk
		GIT_REPOSITORY    git@github.com:php/php-sdk-binary-tools.git
		# GIT_TAG           php-sdk-2.2.0 # TAG 目前不支持 VS2022
		GIT_TAG master # 直接使用 master 的 dev 的可以支持 VS2022
	)
	FetchContent_Populate(phpsdk)

	# TODO 1.写个exe 执行stdin 输入 或 2.找到 CMake 可以操作 stdin 的方法
	# 1. 执行 phpsdk-vs17-x64.bat 进入工具环境，之后都在这个环境下执行命令。
	# 2. buildconf  # 生成 configure
	# 3. configure --enable-cli --disable-zts --enable-phpext=shared  # 生成 makefile
	# 4. nmake  # 执行 make
	#execute_process(
	#	COMMAND "${phpsdk_SOURCE_DIR}/phpsdk-vs17-x64.bat"
	#	WORKING_DIRECTORY "${phpsrc_SOURCE_DIR}"
	#	
	#)
endif()

if(CMAKE_SYSTEM_NAME MATCHES "Linux")
	message(STATUS "make in Linux")
endif()