<?php
include('plantilla/header.php');
?>


<main>


    <section class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-bg-head">
                        <h1>Team Member</h1>
                    </div>
                    <div class="inner-item">
                        <div class="inner-text">
                            <a href="index.html">home</a>
                        </div>
                        <div class="icon">
                            <span><i class="fa-sharp fa-solid fa-angle-right"></i></span>
                        </div>
                        <div class="inner-text">
                            <h5>Team Member</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  


    <section class="team">
        <div class="container">
            <div class="row">
                <?php foreach($equipo as $item): ?>
                <div class="col-lg-3 col-sm-6 team-padd">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="./assets/image/others/them-1.png" alt="thumb">

                            <div class="team-img-overlay">
                                <div class="icon">
                                    <span>
                                        <a href="#" target="_blank">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_153_3988)">
                                                    <path d="M0.48031 15.9532C2.27822 17.0941 4.37066 17.6969 6.53106 17.6969C9.6948 17.6969 12.5939 16.4815 14.6953 14.275C16.706 12.1632 17.8121 9.32551 17.7571 6.44579C18.5193 5.79362 19.4158 4.54835 19.4158 3.33464C19.4158 2.86939 18.9109 2.57405 18.5015 2.81113C17.7854 3.23188 17.1324 3.34193 16.4608 3.1534C15.0893 1.8167 13.0479 1.53512 11.3276 2.46239C9.82426 3.27153 8.98842 4.75226 9.06367 6.37054C6.52378 6.06064 4.17727 4.78705 2.54119 2.80789C2.27256 2.48505 1.7628 2.52308 1.54918 2.88881C0.761082 4.23845 0.769174 5.80252 1.45452 7.06559C1.12843 7.12304 0.926956 7.39733 0.926956 7.69429C0.926956 8.96383 1.49821 10.1306 2.4182 10.9268C2.24666 11.0919 2.19002 11.337 2.26285 11.5555C2.66742 12.7708 3.58336 13.7208 4.72829 14.1965C3.48303 14.7913 2.10587 14.9895 0.880026 14.839C0.24566 14.7532 -0.0674772 15.6061 0.48031 15.9532ZM6.69693 14.4045C7.15086 14.0557 6.90974 13.3291 6.3401 13.317C5.33677 13.296 4.42325 12.8016 3.85442 12.024C4.12872 12.0062 4.41273 11.9641 4.68298 11.8913C5.29874 11.7246 5.26961 10.8362 4.64414 10.7108C3.50892 10.4826 2.61806 9.65564 2.28388 8.59082C2.58893 8.66607 2.89964 8.70814 3.20954 8.71381C3.82368 8.71704 4.0559 7.92975 3.55504 7.60043C2.42629 6.85683 1.94485 5.5436 2.26365 4.30885C4.23472 6.30581 6.90893 7.509 9.73768 7.64493C10.1431 7.67001 10.4473 7.28891 10.3583 6.90295C9.97395 5.23693 10.9045 4.06934 11.9037 3.53126C12.8925 2.99723 14.48 2.83055 15.697 4.10737C16.0587 4.48848 17.2789 4.50304 17.8995 4.35821C17.6211 4.88253 17.1931 5.38015 16.7926 5.66011C16.6218 5.77986 16.5239 5.97891 16.5345 6.18686C16.6647 8.84489 15.6743 11.4875 13.8174 13.4368C11.9466 15.4005 9.35981 16.4824 6.53187 16.4824C5.40716 16.4824 4.30431 16.2995 3.26213 15.9467C4.50821 15.7056 5.69198 15.178 6.69693 14.4045Z" />
                                                </g>
                                            </svg>
                                        </a>

                                    </span>
                                </div>
                                <div class="icon">
                                    <span>
                                        <a href="#">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_153_3997)">
                                                    <path d="M11.4839 19.8666H8.3741C7.85466 19.8666 7.43211 19.4441 7.43211 18.9246V11.9102H5.61777C5.09833 11.9102 4.67578 11.4876 4.67578 10.9683V7.96258C4.67578 7.44314 5.09833 7.02059 5.61777 7.02059H7.43211V5.51545C7.43211 4.02306 7.90074 2.75334 8.78716 1.8438C9.67759 0.930112 10.922 0.447266 12.3858 0.447266L14.7575 0.451118C15.276 0.452007 15.6978 0.874553 15.6978 1.39311V4.18381C15.6978 4.70325 15.2754 5.1258 14.7562 5.1258L13.1593 5.12639C12.6723 5.12639 12.5483 5.22403 12.5218 5.25395C12.4781 5.30359 12.4261 5.44389 12.4261 5.83133V7.02044H14.6361C14.8025 7.02044 14.9637 7.06148 15.1022 7.13882C15.4011 7.30579 15.5869 7.62152 15.5869 7.96273L15.5857 10.9684C15.5857 11.4876 15.1631 11.9101 14.6437 11.9101H12.4261V18.9246C12.4261 19.4441 12.0034 19.8666 11.4839 19.8666ZM8.57056 18.7282H11.2875V11.4006C11.2875 11.0537 11.5697 10.7717 11.9164 10.7717H14.4472L14.4483 8.15903H11.9163C11.5696 8.15903 11.2875 7.87694 11.2875 7.5301V5.83133C11.2875 5.38655 11.3327 4.88074 11.6684 4.50057C12.074 4.04098 12.7133 3.98794 13.159 3.98794L14.5594 3.98735V1.58927L12.3849 1.58571C10.0324 1.58571 8.57056 3.09159 8.57056 5.51545V7.5301C8.57056 7.87679 8.28846 8.15903 7.94177 8.15903H5.81423V10.7717H7.94177C8.28846 10.7717 8.57056 11.0537 8.57056 11.4006V18.7282Z"></path>
                                                </g>

                                            </svg>
                                        </a>



                                    </span>
                                </div>
                                <div class="icon">
                                    <span>
                                        <a href="#" target="_blank">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_153_4001)">
                                                    <path d="M2.71927 0.259766C2.00724 0.259766 1.35991 0.518703 0.87443 1.00419C0.356594 1.52202 0.0976562 2.16931 0.0976562 2.84899C0.0976562 3.56102 0.388947 4.20834 0.87443 4.69383C1.35991 5.17931 2.03959 5.4706 2.68692 5.43825C2.68692 5.43825 2.71927 5.43825 2.75166 5.43825C3.39898 5.43825 4.01392 5.17931 4.4994 4.69383C4.98489 4.20834 5.27618 3.56102 5.27618 2.84899C5.30853 2.16931 5.01724 1.52199 4.53175 1.0365C4.04627 0.518665 3.39895 0.259766 2.71927 0.259766ZM4.04627 4.24073C3.69024 4.59677 3.20475 4.82331 2.68692 4.79096C2.20143 4.79096 1.6836 4.59677 1.32756 4.24073C0.939174 3.8847 0.744981 3.36686 0.744981 2.84903C0.744981 2.33119 0.939174 1.84571 1.32756 1.45732C1.6836 1.10128 2.16908 0.90709 2.71927 0.90709C3.20475 0.90709 3.69024 1.10128 4.04627 1.45732C4.43466 1.84571 4.62885 2.33119 4.62885 2.84903C4.62885 3.36686 4.43466 3.8847 4.04627 4.24073Z" />
                                                    <path d="M3.98113 6.08594H1.35951C0.841676 6.08594 0.420898 6.50668 0.420898 7.0569V18.3849C0.420898 18.9027 0.874029 19.3558 1.39187 19.3558H3.98113C4.49896 19.3558 4.95209 18.9027 4.95209 18.4172V7.0569C4.95209 6.53903 4.49896 6.08594 3.98113 6.08594ZM4.30477 18.4172C4.30477 18.5791 4.14293 18.7085 3.98113 18.7085H1.39187C1.23003 18.7085 1.06822 18.5467 1.06822 18.3849V7.0569C1.06822 6.89506 1.19767 6.73326 1.35951 6.73326H3.98113C4.14297 6.73326 4.30477 6.8951 4.30477 7.0569V18.4172Z" />
                                                    <path d="M14.9855 5.76172H14.3058C13.0436 5.76172 11.8461 6.31195 11.0693 7.18582V6.73269C11.0693 6.40904 10.7456 6.08536 10.422 6.08536H7.18541C6.89412 6.08536 6.53809 6.3443 6.53809 6.7003V18.7727C6.53809 19.1287 6.89412 19.3552 7.18541 19.3552H10.7456C11.0369 19.3552 11.393 19.1287 11.393 18.7727V11.7817C11.393 10.7136 12.1697 9.8721 13.1731 9.8721C13.6909 9.8721 14.1764 10.0663 14.5324 10.4223C14.8561 10.7136 14.9855 11.1667 14.9855 11.7493V18.7079C14.9855 19.0316 15.3092 19.3553 15.6329 19.3553H18.8694C19.1931 19.3553 19.5167 19.0316 19.5167 18.7079V10.3576C19.5167 7.7684 17.5424 5.76172 14.9855 5.76172ZM18.8694 18.6756L18.837 18.7079H15.6652L15.6328 11.7494C15.6328 10.9726 15.4386 10.39 15.0179 9.96927C14.5324 9.48379 13.8851 9.22485 13.2054 9.22485C11.8461 9.2572 10.778 10.3577 10.778 11.7817V18.7079H7.21776V6.73269H10.422L10.4543 6.76504V8.80407L11.3282 7.9302L11.3605 7.89785C12.0079 6.99162 13.1406 6.40904 14.3382 6.40904H15.0179C17.1863 6.40904 18.8694 8.15679 18.8694 10.3577V18.6756Z" />
                                                </g>

                                            </svg>
                                        </a>


                                    </span>
                                </div>
                                <div class="icon">
                                    <span>
                                        <a href="#" target="_blank">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_153_3992)">
                                                    <path d="M12.7944 8.93544L8.50419 6.58802C8.25751 6.45305 7.96593 6.45809 7.72414 6.60136C7.4822 6.74477 7.33789 6.99812 7.33789 7.27933V11.9339C7.33789 12.2137 7.48131 12.4666 7.72162 12.6102C7.84711 12.6852 7.98623 12.7228 8.12565 12.7228C8.25336 12.7228 8.38137 12.6912 8.49915 12.6278L12.7895 10.3209C13.0442 10.1838 13.2032 9.91906 13.2044 9.6297C13.2054 9.34035 13.0483 9.07441 12.7944 8.93544ZM8.47589 11.3483V7.86959L11.6823 9.62407L8.47589 11.3483Z" />
                                                    <path d="M19.3722 5.92071L19.3713 5.91182C19.3549 5.75551 19.1912 4.3652 18.5153 3.65804C17.7341 2.82628 16.8484 2.72524 16.4224 2.67679C16.3871 2.67279 16.3548 2.66909 16.326 2.66523L16.292 2.66168C13.7247 2.475 9.8476 2.44952 9.80879 2.44937L9.80538 2.44922L9.80197 2.44937C9.76315 2.44952 5.88601 2.475 3.29562 2.66168L3.26139 2.66523C3.23384 2.66894 3.20346 2.67234 3.17042 2.6762C2.74936 2.72479 1.87315 2.82598 1.08969 3.68782C0.445948 4.38742 0.259862 5.74795 0.24075 5.90085L0.238527 5.92071C0.232749 5.98575 0.0957031 7.53415 0.0957031 9.08862V10.5418C0.0957031 12.0962 0.232749 13.6446 0.238527 13.7098L0.239564 13.7196C0.25601 13.8734 0.419576 15.2382 1.09236 15.9457C1.82693 16.7496 2.75573 16.8559 3.25532 16.9131C3.33429 16.9222 3.40229 16.9299 3.44866 16.938L3.49356 16.9442C4.97588 17.0853 9.62344 17.1548 9.82049 17.1576L9.82642 17.1577L9.83235 17.1576C9.87116 17.1574 13.7482 17.132 16.3154 16.9453L16.3494 16.9417C16.3818 16.9374 16.4183 16.9336 16.4583 16.9294C16.877 16.885 17.7484 16.7927 18.5211 15.9426C19.1648 15.2428 19.351 13.8823 19.37 13.7295L19.3722 13.7097C19.378 13.6445 19.5152 12.0962 19.5152 10.5418V9.08862C19.5151 7.53415 19.378 5.9859 19.3722 5.92071ZM18.3771 10.5418C18.3771 11.9805 18.2514 13.4622 18.2396 13.5983C18.1913 13.9729 17.995 14.8337 17.6813 15.1747C17.1977 15.7067 16.7009 15.7594 16.3383 15.7978C16.2944 15.8024 16.2538 15.8068 16.2171 15.8114C13.7339 15.991 10.0032 16.0186 9.83131 16.0196C9.63855 16.0168 5.05899 15.9467 3.62186 15.8132C3.54823 15.8012 3.46867 15.792 3.38481 15.7825C2.95945 15.7338 2.37719 15.6671 1.92945 15.1747L1.91893 15.1634C1.61077 14.8423 1.42009 14.0374 1.37164 13.6027C1.3626 13.4999 1.2337 12.0007 1.2337 10.5418V9.08862C1.2337 7.65149 1.35905 6.17139 1.37119 6.03257C1.42883 5.5912 1.62884 4.78256 1.92945 4.45572C2.42786 3.90754 2.95337 3.84679 3.30095 3.80664C3.33414 3.80279 3.3651 3.79923 3.3937 3.79553C5.91298 3.61507 9.67056 3.58826 9.80538 3.58722C9.9402 3.58811 13.6965 3.61507 16.1934 3.79553C16.224 3.79938 16.2575 3.80323 16.2935 3.80738C16.651 3.84813 17.1913 3.90976 17.6872 4.43868L17.6918 4.44357C18 4.76463 18.1907 5.58365 18.2391 6.02708C18.2477 6.12413 18.3771 7.6266 18.3771 9.08862V10.5418Z" />
                                                </g>

                                            </svg>

                                        </a>



                                    </span>
                                </div>
                            </div>


                        </div>
                        <div class="team-text">
                            <h3><?= $item['nombre'] ?></h3>
                            <p><?= $item['area'] ?></p>
                        </div>
                    </div>
                </div>
               <?php endforeach ?>

            </div>
            <div class="row ">
                <div class="col-lg-12">
                    <div class="h-1-blog-btn">
                        <nav aria-label="...">
                            <ul class="pagination">
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="fa-solid fa-angle-left"></i></span>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item " aria-current="page">
                                    <span class="page-link">2</span>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fa-solid fa-angle-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>





    <section class="customers">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="coustomers-text">
                        <h2>Take care of more than 100K customers</h2>
                    </div>
                    <div class="customers-item">
                        <div class="customers-inner">
                            <div class="customers-img">
                                <img src="./assets/image/others/Google.png" alt="google" />
                            </div>
                            <div class="customers-img">
                                <img src="./assets/image/others/Slack.png" alt="Slack" />
                            </div>
                            <div class="customers-img">
                                <img src="./assets/image/others/Amazon.png" alt="Amazon" />
                            </div>
                            <div class="customers-img">
                                <img src="./assets/image/others/Spotify.png" alt="Spotify" />
                            </div>
                            <div class="customers-img">
                                <img src="./assets/image/others/Linked.png" alt="Linked" />
                            </div>
                            <div class="customers-img">
                                <img src="./assets/image/others/Walmart.png" alt="Walmart" />
                            </div>
                            <div class="customers-img">
                                <img src="./assets/image/others/Google.png" alt="google" />
                            </div>
                            <div class="customers-img">
                                <img src="./assets/image/others/Slack.png" alt="Slack" />
                            </div>
                            <div class="customers-img">
                                <img src="./assets/image/others/Amazon.png" alt="Amazon" />
                            </div>
                            <div class="customers-img">
                                <img src="./assets/image/others/Spotify.png" alt="Spotify" />
                            </div>
                            <div class="customers-img">
                                <img src="./assets/image/others/Linked.png" alt="Linked" />
                            </div>
                            <div class="customers-img">
                                <img src="./assets/image/others/Walmart.png" alt="Walmart" />
                            </div>
                            <div class="customers-img">
                                <img src="./assets/image/others/Walmart.png" alt="Walmart" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>





            <div class="row">
                <div class="col-lg-12">
                    <div class="customer-head">
                        <span>CUSTOMER REVIEWS</span>
                        <h2>What’s Our Customer Say</h2>
                    </div>
                </div>
            </div>

            <div class="row customer-head-item-slick ">
                <div class="col-lg-6 mart">
                    <div class="customer-head-item">
                        <div class="icon">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="text">
                            <p>“There are many variations of passages of Lorem Ipsum available, majority have into the find end to suffered.”</p>
                        </div>
                        <div class="customer-head-inner">
                            <div class="customer-head-innner-df">
                                <div class="customer-head-inner-img">
                                    <img src="./assets/image/others/Customer-1.png" alt="Customer-thumb" />
                                </div>
                                <div class="customer-head-inner-text">
                                    <h4>Guy Hawkins</h4>
                                    <p>Web Designer</p>
                                </div>
                            </div>

                            <div class="customer-head-inner-left">
                                <img src="./assets/image/others/Customer-left.png" alt="Customer-thumb" />
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 mart">
                    <div class="customer-head-item">
                        <div class="icon">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="text">
                            <p>“There are many variations of passages of Lorem Ipsum available, majority have into the find end to suffered.”</p>
                        </div>
                        <div class="customer-head-inner">
                            <div class="customer-head-innner-df">
                                <div class="customer-head-inner-img">
                                    <img src="./assets/image/others/Customer-2.png" alt="Customer-thumb" />
                                </div>
                                <div class="customer-head-inner-text">
                                    <h4>Guy Hawkins</h4>
                                    <p>Web Designer</p>
                                </div>
                            </div>

                            <div class="customer-head-inner-left">
                                <img src="./assets/image/others/Customer-left.png" alt="Customer-thumb" />
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 mart">
                    <div class="customer-head-item">
                        <div class="icon">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="text">
                            <p>“There are many variations of passages of Lorem Ipsum available, majority have into the find end to suffered.”</p>
                        </div>
                        <div class="customer-head-inner">
                            <div class="customer-head-innner-df">
                                <div class="customer-head-inner-img">
                                    <img src="./assets/image/others/Customer-2.png" alt="Customer-thumb" />
                                </div>
                                <div class="customer-head-inner-text">
                                    <h4>Guy Hawkins</h4>
                                    <p>Web Designer</p>
                                </div>
                            </div>

                            <div class="customer-head-inner-left">
                                <img src="./assets/image/others/Customer-left.png" alt="Customer-thumb" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="skills">
    <div class="container">
      <div class="row ">
        <div class="col-lg-12">
          <div class="skill-text">
            <h2>Contamos <br>
              con el respaldo de.</h2>
          </div>

        </div>
      </div>
      <div class="row mar-top">

        <?php foreach ($respaldo as $item) : ?>
          <div class="col-lg-4  m-r">
            <div class="service-overelay"></div>
            <img class="bordered-image" style=" height: auto; display: block; margin: 0 auto;" src="<?= base_url('public/assets/image/others/' . $item['logo_respaldo']); ?>" alt="">
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>





</main>














<?php include('plantilla/footer.php')  ?>