# TikTok Downloader

This is a TikTok video downloader script that allows users to download TikTok videos without a watermark. The script utilizes [yt-dlp](https://github.com/yt-dlp/yt-dlp) for downloading, along with FFmpeg to handle video processing.

## Features
- Download TikTok videos directly from video URLs.
- Remove watermarks from downloaded TikTok videos.
- Easy installation and setup on your own server.

## Installation

### 1. Download and Upload Files

1. Download the latest release from the [Releases](https://github.com/your-github-repo/releases) section of this repository.
2. Upload the downloaded files to your server in the desired directory (e.g., `/var/www/html/tiktok-downloader`).

### 2. Install yt-dlp and FFmpeg

Depending on your server’s OS, follow the steps below to install `yt-dlp` and `FFmpeg`.

#### For Ubuntu 18 and up / Debian 10 and up:

1. **Update the system**:
    ```bash
    sudo apt update
    sudo apt upgrade
    ```

2. **Install required packages**:
    ```bash
    sudo apt install python3 python3-pip ffmpeg
    ```

3. **Install yt-dlp**:
    - Method 1: Using pip:
        ```bash
        sudo pip3 install yt-dlp
        ```
    - Method 2: Using wget:
        ```bash
        sudo wget https://github.com/yt-dlp/yt-dlp/releases/latest/download/yt-dlp -O /usr/local/bin/yt-dlp
        sudo chmod a+rx /usr/local/bin/yt-dlp
        ```

4. **Test installation**:
    ```bash
    yt-dlp --version
    ffmpeg -version
    ```

#### For AlmaLinux, CentOS, or Rocky Linux 7 and up:

1. **Update the system**:
    ```bash
    sudo yum update
    ```

2. **Install EPEL and RPM Fusion repositories**:
    ```bash
    sudo yum install epel-release
    sudo yum install https://download1.rpmfusion.org/free/el/rpmfusion-free-release-7.noarch.rpm
    ```

3. **Install FFmpeg**:
    ```bash
    sudo yum install ffmpeg ffmpeg-devel
    ```

4. **Install Python 3 and pip**:
    ```bash
    sudo yum install python3 python3-pip
    ```

5. **Install yt-dlp**:
    - Method 1: Using pip:
        ```bash
        sudo pip3 install yt-dlp
        ```
    - Method 2: Using wget:
        ```bash
        sudo wget https://github.com/yt-dlp/yt-dlp/releases/latest/download/yt-dlp -O /usr/local/bin/yt-dlp
        sudo chmod a+rx /usr/local/bin/yt-dlp
        ```

6. **Test installation**:
    ```bash
    yt-dlp --version
    ffmpeg -version
    ```

## Usage

Once you've installed the script on your server, users can access it via their browser. To download a TikTok video without a watermark:

1. Enter the TikTok video URL into the input field on the page.
2. Click the "Download" button.
3. The script will process the video and provide a download link once ready.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
