<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function listFolderFiles($dir)
{
    $ffs = scandir($dir);
    unset($ffs[array_search('.', $ffs, true)]);
    unset($ffs[array_search('..', $ffs, true)]);
    sort($ffs);
    for ($i = 0; $i < count($ffs); $i++) {
        $ffs1url = $dir . '/' . $ffs[$i];
        $ffs1 = scandir($ffs1url);
        unset($ffs1[array_search('.', $ffs1, true)]);
        unset($ffs1[array_search('..', $ffs1, true)]);
        sort($ffs1);
        indexHtml($ffs1url);
        if (!empty($ffs1)) {

            for ($j = 0; $j < count($ffs1); $j++) {
                $ffs2url = $dir . '/' . $ffs[$i] . '/' . $ffs1[$j];
                $ffs2    = scandir($ffs2url);
                unset($ffs2[array_search('.', $ffs2, true)]);
                unset($ffs2[array_search('..', $ffs2, true)]);
                sort($ffs2);
                indexHtml($ffs2url);
                if (!empty($ffs2)) {
                    for ($k = 0; $k < count($ffs2); $k++) {
                        $ffs3url = $dir . '/' . $ffs[$i] . '/' . $ffs1[$j] . '/' . $ffs2[$k];
                        $ffs3    = scandir($ffs3url);
                        unset($ffs3[array_search('.', $ffs3, true)]);
                        unset($ffs3[array_search('..', $ffs3, true)]);
                        sort($ffs3);
                        indexHtml($ffs3url);

                        if (!empty($ffs3)) {
                            for ($l = 0; $l < count($ffs3); $l++) {
                                $ffs4url = $dir . '/' . $ffs[$i] . '/' . $ffs1[$j] . '/' . $ffs2[$k] . '/' . $ffs3[$l];
                                $ffs4    = scandir($ffs4url);
                                unset($ffs4[array_search('.', $ffs4, true)]);
                                unset($ffs4[array_search('..', $ffs4, true)]);
                                sort($ffs4);
                                indexHtml($ffs4url);

                                if (!empty($ffs4)) {
                                    for ($m = 0; $m < count($ffs4); $m++) {
                                        $ffs5url = $dir . '/' . $ffs[$i] . '/' . $ffs1[$j] . '/' . $ffs2[$k] . '/' . $ffs3[$l] . '/' . $ffs4[$m];
                                        $ffs5    = scandir($ffs5url);
                                        unset($ffs5[array_search('.', $ffs5, true)]);
                                        unset($ffs5[array_search('..', $ffs5, true)]);
                                        sort($ffs5);
                                        indexHtml($ffs5url);

                                        if (!empty($ffs5)) {
                                            for ($n = 0; $n < count($ffs5); $n++) {
                                                $ffs6url = $dir . '/' . $ffs[$i] . '/' . $ffs1[$j] . '/' . $ffs2[$k] . '/' . $ffs3[$l] . '/' . $ffs4[$m] . '/' . $ffs5[$n];
                                                $ffs6    = scandir($ffs6url);
                                                unset($ffs6[array_search('.', $ffs6, true)]);
                                                unset($ffs6[array_search('..', $ffs6, true)]);
                                                sort($ffs6);
                                                indexHtml($ffs6url);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function indexHtml($folderRoot = NULL)
{
    ob_start();
    // Create the HTML page content
    print '<!DOCTYPE html>
            <html>
            <head>
                <title>
                    403 forbidden access
                </title>
                <style>
                    i {
                        color:red;
                    }
                </style>
            </head>
            <body>
                <div class="container py-5">
                    <div class="row">
                        <div class="col-md-2 text-center">
                            <p><i class="fa fa-exclamation-triangle fa-5x"></i><br/>Status Code: 403</p>
                        </div>
                        <div class="col-md-10">
                            <h3>Sorry...</h3>
                            <p>
                                Sorry, your access is refused due to security reasons of our server and also our sensitive data.
                            </p>
                        </div>
                    </div>
                </div>
            </body>
            </html>';
    // At the end of the PHP script, write the buffered content to a file
    $content = ob_get_clean();
    $target  = $folderRoot . '/index.html';
    if (!file_exists($target)) {
        file_put_contents($target, $content);
    }
}
