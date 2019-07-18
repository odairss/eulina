<section id="videos" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 section-wrapper">
    <h1>GALERIA DE VÍDEOS</h1>
    <div class="container-videos">
        <div id="ytplayer1" class="player-videos"></div>
        <div id="ytplayer2" class="player-videos"></div>
        <div id="ytplayer3" class="player-videos"></div>
        <div id="ytplayer4" class="player-videos"></div>
        <script>
            // Load the IFrame Player API code asynchronously.
            var tag = document.createElement('script');
            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            // This function creates an <iframe> (and YouTube player)
            //    after the API code downloads.
            var player;
            function onYouTubePlayerAPIReady() {

                player = new YT.Player('ytplayer1', {
                    playerVars: {
                        listType: 'playlist',
                        list: 'PLwcq684yQqqTSQce_GG150Ak81vb-F4NO',
                        controls: 1,
                        autoplay: 0,
                        showinfo: 0,
                        enablejsapi: 1,
                        modestbranding: 1,
                        fs: 1,
                        origin: 'http://www.orquestrasinfonicadorn.com.br',
                        rel: 0
                    }
                });

                player = new YT.Player('ytplayer2', {
                    playerVars: {
                        listType: 'playlist',
                        list: 'PLwcq684yQqqQY8lnidNUDYBKp9NNcSm0P',
                        controls: 1,
                        autoplay: 0,
                        showinfo: 0,
                        enablejsapi: 1,
                        modestbranding: 1,
                        fs: 1,
                        origin: 'http://www.orquestrasinfonicadorn.com.br',
                        rel: 0
                    }
                });


                player = new YT.Player('ytplayer3', {
                    playerVars: {
                        listType: 'playlist',
                        list: 'PLwcq684yQqqQGI2e2JBrOlaABJuNZWP4P',
                        controls: 1,
                        autoplay: 0,
                        showinfo: 0,
                        enablejsapi: 1,
                        modestbranding: 1,
                        fs: 1,
                        origin: 'http://www.orquestrasinfonicadorn.com.br',
                        rel: 0
                    }
                });


                player = new YT.Player('ytplayer4', {
                    videoId: 'Od2uV2kX7E0',
                    playerVars: {
                        controls: 1,
                        autoplay: 0,
                        showinfo: 0,
                        enablejsapi: 1,
                        modestbranding: 1,
                        fs: 1,
                        origin: 'http://www.orquestrasinfonicadorn.com.br',
                        rel: 0
                    }
                });


            }

        </script>
    </div>

</section>