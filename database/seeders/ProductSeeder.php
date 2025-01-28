<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'thumbnail' => 'espresso-con-panna.webp',
                'title' => 'Espresso Con Panna',
                'price' => 100.00,
                'body' => 'Espresso yu asortize edikceksek ve de alışmayan bünyelere sevdireceksek ona da internet dilinde bir kulp takıcaksak "Şukela" yeterli olur sanırsak',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'espresso-ristretto.webp',
                'title' => 'Espresso Ristretto',
                'price' => 75.00,
                'body' => 'İlk damlalar kahvenin en yoğun geldiği damlalar olduğu için konsantre bir lezzet vardır. Akış miktarı arttıkça başlıktan gelen kahve yoğunluğu giderek düşer. İşte bu ilk yudumları daha çok seven İtalyanlar double espresso\'yu 40ml su ile hazırlayarak buna kısıtlı anlamına gelen ristretto ismini vermişler. Aynı miktarda kahve ve daha az suyla hazırlandığı için daha yoğun bir lezzete sahip olan ristretto özellikle sabah uyanmak için birebir. Günümüzün Türçe  tabiriyle İngilazca konuşan bünyelerin  "bir quickie" siparişidir.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'espresso-single.webp',
                'title' => 'Espresso Single',
                'price' => 75.00,
                'body' => 'Temelde" espresso, demleme yöntemine verilen ad. Espresso makinesinde demlenen kahvenin adı espresso oluyor. Özelliği ise, kahveyi 30 sn gibi kısa bir sürede, yaklaşık 9 bar basınç ile suyu kahvenin içerisinden geçirmek suretiyle demlemesi. Bu yöntemle kahvenin içerisindeki tüm yağlar ve asitler de bardağa aktarılıyor. Kahve terminolojisine biz de imza atalım dersek  " kurşun asker " diyebiliriz.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'affogato.webp',
                'title' => 'Affogato',
                'price' => 105.00,
                'body' => 'Sıcak ve soğuğu aynı anda sunan lezzetli bir kahve.  Espresso\'nun sertliği, dondurma ile azaltıldığı için yumuşak bir içimi vardır. Siz farklısını söylemezseniz vanilyalı dondurmayla servis ediliyor.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'espresso-decaf.webp',
                'title' => 'Espresso Decaf',
                'price' => 80.00,
                'body' => 'Bir shot espresso genellikle zihni uyandırırmak içindir ve bu nedenle birinin shot espressosu olmak, onun ruh halini bir ton yükselttiğiniz anlamına gelir.  Underground olarak sizin için asansör etkisinde robusta ve arabica\'nın kalitesini harmanlayarak yoğun bir tat ve güçlü içim kahve deneyimi sunar. Kafeinsiz karakteristik tatları sevenler için mükemmel seçim.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'cafe-miel.webp',
                'title' => 'Cafe Miel',
                'price' => 120.00,
                'body' => 'Yumuşak içimli  bal, süt,  espresso denklemine adının anlamı gibi  bir masal havası vaat ediyor.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'espresso-doppio.webp',
                'title' => 'Espresso Doppio',
                'price' => 90.00,
                'body' => 'Yoğun bir kıvama ve sert bir tada sahiptir. 60 ml basınçlandırılan su ile espresso çekirdeğinin hamam sefasıdır.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'espresso-lungo.webp',
                'title' => 'Espresso Lungo',
                'price' => 95.00,
                'body' => 'Bir shot espresso genellikle zihni uyandırırması içindir,bu nedenle birinin shot espressosu olmak, onun ruh halini bir ton yükselttiğiniz anlamına gelir.  Underground Coffee Shop  sizin için asansör etkisinde robusta ve arabica\'nın kalitesini harmanlayarak yoğun bir tat ve güçlü içim kahve deneyimi sunar. Karakteristik tatları sevenler için mükemmel seçim. Lungo sevenler için espresso yanında sıcak su servis ediyoruz istediğiniz yumuşaklığa karar verebilmeniz için',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'espresso-double.webp',
                'title' => 'Espresso Double',
                'price' => 90.00,
                'body' => 'Double shot espresso genellikle zihni uyandırırmak içindir',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'espresso-macchiato.webp',
                'title' => 'Espresso Macchiato',
                'price' => 95.00,
                'body' => 'Espresso macchiato, genellikle klasik espresso üzerine birkaç damla süt köpüğünün eklendiği bir kahve içeceğidir. İtalyanca\'da "lekenin olduğu espresso" anlamına gelir. Bu kahve, yoğun espresso tadını hafif bir süt lekesiyle birleştirir. İçeceğin temelinde, espresso\'nun zengin ve koyu aroması süt köpüğünün hafif dokunuşuyla buluşur.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'americano.webp',
                'title' => 'Americano',
                'price' => 115.00,
                'body' => 'Americano, bir Espresso\'nun sıcak su ile seyreltilmesiyle yapılır. Ne kadar sıcak su kullanılacağına dair özel bir kılavuz yoktur. Bazı insanlar 1:2 Espresso su oranının "standart" bir Americano olduğunu iddia ederken, diğerleri 1:1 oranlı bir Americano\'yu tercih eder. Gerçekte kahve dükkanları, Espressolarının yoğunluğuna ve müşterilerin damak zevkine bağlı olarak 1:15\'e kadar yüksek bir oran kullanabilir. Espresso sertliğine alışık olmayan bünyeler için daha yumuşak bir deneyim olup Amerikano nun afilli ismine bakıp Amerikancı bünyeleri hayal kırıklığına uğratmayacağımıza emin olabilirsiniz.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'mocha.webp',
                'title' => 'Mocha',
                'price' => 135.00,
                'body' => 'Kahve ile çikolatanın  valsi olabilir, ...',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'filtre-kahve.webp',
                'title' => 'Filtre Kahve',
                'price' => 110.00,
                'body' => 'Filtre kahve, öğütülmüş kahve çekirdeklerinin sıcak suyla buluşturulup demlenmesi sonucu elde edilen kahve çeşididir. Genel olarak farklı tipte ürün skalaları fanatiklerini de oluşturmuştur. Underground olarak karakteristik ve gövdeli kahve deneyimi sunarken kahve adına dip not bilgiler vermek gerekirse yağ yakıcıdır, diyabet kontrolüne destek verir, Alzheimer önleyici olup tam bir antioksidan deposudur demek yeterli olur şimdilik.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'decaf-filtre-kahve.webp',
                'title' => 'Decaf Filtre Kahve',
                'price' => 115.00,
                'body' => '"Decaf" olarak da adlandırılan bu içecek aslında tamamen kafeinsiz değildir çünkü kafein, bitkinin kendisinde ve çekirdeklerinde doğal olarak bulunur ve Kafeinsiz kahve çeşitleri ise normale göre yaklaşık olarak  %97 oranında daha az kafein içerir.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'cappucino.webp',
                'title' => 'Cappucino',
                'price' => 125.00,
                'body' => 'Genel haliyle tanımlayacak olursak dünya çapında oldukça popüler olan cappuccino, kuvvetli buharda demlenmiş süt köpüğü ile hazırlanan espresso bazlı bir kahve türüdür. Rivayete göre cappuccino kahvesine adını veren olay; Capuchin rahiplerinin kıyafetlerinin, cappuccino kahvesine benzetilmesinden gelmektedir.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'cortado.webp',
                'title' => 'Cortado',
                'price' => 110.00,
                'body' => 'İspanyolca da Cortado, kahvenin sütle kesildiği anlamına gelen kesme anlamına gelir . Cortado kahvesi, eşit miktarda espresso ve buharda pişirilmiş sütten yapılır.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'flat-white.webp',
                'title' => 'Flat White',
                'price' => 115.00,
                'body' => 'Latte den daha az süt ile yapılan zamanının beceriksiz Avusturalya\'lı baristanın çıkardığı icat diyelim. Genellikle gün ortasında içilen latteye göre daha çok espresso tadı alınabilen içecektir.  ',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'latte-macchiato.webp',
                'title' => 'Latte Macchiato',
                'price' => 125.00,
                'body' => 'Kademeli görünümüyle özel zevklerim var demenin kahvedeki klasik yolu.... Esmer şeker ile  her zaman favori..',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'underground-latte.webp',
                'title' => 'Underground Latte',
                'price' => 140.00,
                'body' => 'Underground olarak İmza ürün olarak illaki bir şeyler düşündük. Tropik -kabuklu kombinasyonu tabiki de süt ve espresso deneyin deriz.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'cafe-latte.webp',
                'title' => 'Cafe Latte',
                'price' => 120.00,
                'body' => 'Klasiktir pek tarif istemez sanırsak. Kahve kültürü olmayanların zamanında kedi sahibi bir kadının dükkanı diye düşündürten ismi ile  hala  İtalyan Güzeli',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'aromalı-latte.webp',
                'title' => 'Aromalı Latte',
                'price' => 135.00,
                'body' => 'Latte sütün bol olduğu içecek anlamı verirken bunu kendi zevkine göre özelleştirmek isteyen tarzını belirlesin. Seçenekler : Fındık, Vanilya, Hind Ceviz, Karamel, Ruby, Balkabağı, Lotus, Bitter, ',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'ice-americano.webp',
                'title' => 'Ice Americano',
                'price' => 120.00,
                'body' => 'Bu amerikalılar ve tabiki bizim amarikancılar işi gene sulandırmış. Merak etmeyin kahvesini güçlü yapıyoruz paranızın sonuna kadar kahvesini de siz kalkana kadar masada bırakıyoruz.',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'ice-filter.webp',
                'title' => 'Ice Filter',
                'price' => 130.00,
                'body' => 'Filtre Kahvemi buzlu içmeyi severim diyenler için',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'ice-latte.webp',
                'title' => 'Ice Latte',
                'price' => 125.00,
                'body' => 'Lattenin cooler formu olup kahve ve sütün inanılmaz dansı herkesi büyülemiştir.',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'aromalı-ice-latte.webp',
                'title' => 'Aromalı Ice Latte',
                'price' => 140.00,
                'body' => 'Sütlü, buzlu,  kahveli olan bu denkleme istediğiniz aroma ile şenlendirin Ruby, Karamel, Hindistan Ceviz, Lotus, Vanilya, Beyaz Çik, Bitter, Fındık, Bal Kabak, Irish Cream vb..',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'ice-mocha.webp',
                'title' => 'Ice Mocha',
                'price' => 145.00,
                'body' => 'Mocha ile ilgili bildiğiniz herşeyi cooler modunda tüketmek için birebir. Çikolata, espresso, süt ün göz kırpışı diyelim romantizme de hizmet etmiş olallım.',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'aromalı-ice-mocha.webp',
                'title' => 'Aromalı Ice Mocha',
                'price' => 170.00,
                'body' => 'Mocha nın ruhu bu aromalarla yeniden tasarlandı. Araba gibi düşünün ve modele siz karar verin... Ruby, Karamel, Hindistan Ceviz, Lotus, Vanilya, Beyaz Çik, , Fındık, Irish Cream',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'frappe.webp',
                'title' => 'Frappe',
                'price' => 150.00,
                'body' => 'Yunanistan\'dan dünya yayılan serinlik. Granül kahvenin bu kadar yol alabileceğini kim bilebilirdi.',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'aromalı-frappe.webp',
                'title' => 'Aromalı Frappe',
                'price' => 165.00,
                'body' => 'Fındıklı, Çikolatalı, Vanilyalı, Karamelli, Hindistan Cevizli, Irish Cream',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'ice-underground.webp',
                'title' => 'Ice Underground',
                'price' => 155.00,
                'body' => 'Bu üründe de biz kendi dokunuşunuzu yaptık. Underground ruhuna tropik ve toprak dengesi öneriyoruz. Sunumu da hiç fena değil diyorlar.',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'iced-chai-tea-latte.webp',
                'title' => 'Iced Chai Tea Latte',
                'price' => 155.00,
                'body' => 'Tarçın, baharatlar, siyah çay ve şekerin, buharda ısıtılmış süt ve süt köpüğü ile egzotik birleşimi. Son dönemlerin enteresan tercihlerinden . Farklı şeyler denemeye hazır olanların bolca tercih ettiği bir ürün oldu',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'iced-matcha-latte.webp',
                'title' => 'Iced Matcha Latte',
                'price' => 170.00,
                'body' => 'Buzlu içeceklerde seçiminiz deneysel olarak kahve, süt ve bitkisel aromalar üzerine olacaksa son dönemlerdeki yenilik arayanların favorisi olarak menümüzde yerini aldı. ',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'iced-chocolate.webp',
                'title' => 'Ice Chocolate',
                'price' => 160.00,
                'body' => 'Hem serin hem uzun içim hem de şeker patlması olsun ama bayılmamam lazım diyenlerin fantazisidir. Aslında ismi gibi de erotik bir tat. Siz sadece aromasını belirleyin gerisi bizde. Ruby, Caramel, Vanilya, Beyaz Çikolata, Beyaz Çikolata, Lotus',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'iced-salepso.webp',
                'title' => 'Iced Salepso',
                'price' => 165.00,
                'body' => 'Espresoo ve sahlep için uzun serin formu',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'chai-tea-latte.webp',
                'title' => 'Chai Tea Latte',
                'price' => 125.00,
                'body' => 'Tarçın, baharatlar, siyah çay ve şekerin, buharda ısıtılmış süt ve süt köpüğü ile egzotik birleşimi. Son dönemlerin enteresan tercihlerinden',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'matcha-latte.webp',
                'title' => 'Matcha Latte',
                'price' => 160.00,
                'body' => 'Matcha Latte, yüksek kaliteli matcha tozunun sıcak suyla karıştırılması ve ardından bu karışıma sıcak veya soğuk sütlü köpük eklenmesiyle hazırlanan bir içecektir. Bu içecek, Japonya\'dan tüm dünyaya yayılmış olup, geleneksel çay seramoninin bir parçası olarak kabul edilir. Matcha Latte\'nin temel bileşeni olan matcha tozu, gölgede yetiştirilen ve özel olarak işlenen yeşil çay yapraklarından elde edilir. İçeriğindeki antioksidanlar, vitaminler ve mineraller sayesinde sağlık üzerine pek çok olumlu etkisi bulunmaktadır.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'sıcak-çikolata.webp',
                'title' => 'Sıcak Çikolata',
                'price' => 145.00,
                'body' => 'Yoğunluğu arttıkça, tadı da bağıl olarak muhteşemleşen, ılıkken de süper olan, müthiş içecek. Sizin seçiminiz ne ? Çikolata, Beyaz Çikolata, Ruby, Lotus, Karamel ...',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'salep.webp',
                'title' => 'Salep',
                'price' => 130.00,
                'body' => 'Kış dönemi için tüm zamanlarda sevdiğimiz bu içecek Antik Roma döneminde de bilinen ve tüketilen salep içeceği, Anadolu orkidesinin toprak altındaki yumrularından sağlanan tozdan elde edilir. Iskalamayın ve gönül rahatlığıyla sipariş verin porsiyon ve tat garantili.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'mocha-ve-ceşitleri.webp',
                'title' => 'Mocha ve Çeşitleri',
                'price' => 135.00,
                'body' => 'Mocha için hangi stil size ait ...Caramel, Ruby, Lotus, Vanilya, Çikolata',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'turk-kahvesi.webp',
                'title' => 'Türk Kahvesi',
                'price' => 90.00,
                'body' => 'Bildiğimiz bir ritüel siz sadece şekerine karar veriniz nostaljik leblebi şeker vermeyi unutmadık suyu da detoxxxx  ... Otantik tripler bunlar ama elimizden geldiğince ayarı verdik.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'double-turk-kahvesi.webp',
                'title' => 'Double Türk Kahvesi',
                'price' => 130.00,
                'body' => 'Bildiğimiz bir ritüel siz sadece şekerine karar veriniz nostaljik leblebi şeker vermeyi unutmadık suyu da detoxxxx  ... Otantik tripler bunlar ama elimizden geldiğince ayarı verdik.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'damla-sakızlı-kahve.webp',
                'title' => 'Damla Sakızlı Türk Kahve',
                'price' => 95.00,
                'body' => '',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'double-damla-sakızlı-kahve.webp',
                'title' => 'Double Damla Sakızlı Türk Kahve',
                'price' => 135.00,
                'body' => '',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'menengiç-kahvesi.webp',
                'title' => 'Menengiç Kahvesi',
                'price' => 100.00,
                'body' => 'Sakız ağacıgillerden bir meyve olan menengicin  kremsi muhteşemliğin süt veya suyla karıştırılarak içimi hoş bir içecek haline getirilmişi olup menengiç kahve gibi nikotin ve kafein içermediği için acı olmaz.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'double-menengiç-kahvesi.webp',
                'title' => 'Double Menengiç Kahvesi',
                'price' => 140.00,
                'body' => 'Sakız ağacıgillerden bir meyve olan menengicin  kremsi muhteşemliğin süt veya suyla karıştırılarak içimi hoş bir içecek haline getirilmişi olup menengiç kahve gibi nikotin ve kafein içermediği için acı olmaz.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'dibek-kahve.webp',
                'title' => 'Dibek Türk Kahve',
                'price' => 95.00,
                'body' => '',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'double-dibek-kahve.webp',
                'title' => 'Double Dibek Türk Kahve',
                'price' => 135.00,
                'body' => '',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'meyveli-cay.webp',
                'title' => 'Meyveli Çaylar',
                'price' => 40.00,
                'body' => 'Nostaljide kalan günlerimize dair büyüklerimizle çay bahçede ya da pasaj da han aralarında bize hitap edebilen naciz şımarık içecekleri hala sevenler için..ELma, Muz, Kivi, Portakal, Limon,',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'organik-cay.webp',
                'title' => 'Organik Çaylar',
                'price' => 95.00,
                'body' => 'Organikçileri ve mevsimsel alışkanlıkları unutmadık.  Bahçeden diyerek abartı olabilir ama abla tezgahta bunlar var şu an dediklerimiz...Atom Kış Çayı, Hibisküs, Ihlamur, Adaçayı, Kuşburnu, Yeşil Çay, Rezene, Papatya, Melisa',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'klasik-cay.webp',
                'title' => 'Klasik Çay',
                'price' => 30.00,
                'body' => '',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'fincan-cay.webp',
                'title' => 'Fincan Çay',
                'price' => 50.00,
                'body' => 'Çay da ekonomi bu ürünle mümkün :)',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'take-away-cay.webp',
                'title' => 'Take Away Çay',
                'price' => 70.00,
                'body' => 'Karton bardakta al-götür çay',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'sinirsiz-cay.webp',
                'title' => 'Sınırsız Çay',
                'price' => 100.00,
                'body' => 'Kalabalıksak ve de mutlaka 2. içerim diyorsak ama çarpılmasak da diyorsak seçim bu. 6 ince belli bardak servisi alabilirsiniz.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'milkshake.webp',
                'title' => 'Milkshake Çeşitleri',
                'price' => 155.00,
                'body' => 'Milkshake süt, kırılmış buz, çeşitli meyvelerin karışımından oluşan serinletici ve tatlı ihtiyacını anında kesen harika bir içecek!  Vanilya, Çikolata, Caramel, Orman Meyve, Muz, Lotus, Çilek, Frambuaz, Ananas,Mango, Yeşil Elma, Passion Fruit',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'smoothie.webp',
                'title' => 'Smoothie Çeşitleri',
                'price' => 160.00,
                'body' => 'Smoothie, taze meyve ve sebzelerin sıkılmasıyla hazırlanan bir içecektir. Özellikle diyet yapanlar ve sporcular tarafından sık sık tüketilir. Çeşitleri için sorunuz lütfen',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'frozen.webp',
                'title' => 'Frozen Çeşitleri',
                'price' => 165.00,
                'body' => 'Ferahlık veren ve anında serinlemeyi mümkün kılan içeceklerden bir tanesi frozen olarak biline içeceklerdir. Buzlu meyveler kullanılarak hazırlanan frozen çok farklı alternatiflere de sahiptir. Çilekli, Orman Meyveli, Frambuaz, Yeşil Elma, Kavun, Karpuz, Mango, Karadut, Passion Fruit,Ananas',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'limonata.webp',
                'title' => 'Limonata',
                'price' => 100.00,
                'body' => 'Yazlardan kalma bir alışkanlık  Freshhhhhhhhh',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'portakal.webp',
                'title' => 'Sıkma Portakal Suyu',
                'price' => 140.00,
                'body' => 'Tüm zamanların favorisi',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'coca-cola.webp',
                'title' => 'Coca Cola',
                'price' => 80.00,
                'body' => 'Kahve ve çay tarzı bir şey içmek istemeyenleri için alternatif bulunduruyoruz',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'cola-zero.webp',
                'title' => 'Coca Cola Zero',
                'price' => 80.00,
                'body' => 'Şekersiz seçim.',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'beyoglu-gazozu.webp',
                'title' => 'Beyoğlu Gazoz',
                'price' => 80.00,
                'body' => 'Beyoğlu ismiyle beraber zaten UNDERGROUND, marka çatımız altında çok severek bulunduruyoruz ve sıkı içicileriyiz size de öneriririz.',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'beyoglu-zencefil.webp',
                'title' => 'Beyoğlu Gazoz Zencefil',
                'price' => 80.00,
                'body' => 'Doğal zengin mineralli sudan yapılan bu ürün gizli fanatiklerini bekliyor.',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'su.webp',
                'title' => 'Su',
                'price' => 30.00,
                'body' => '',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'maden-suyu.webp',
                'title' => 'Maden Suyu',
                'price' => 50.00,
                'body' => 'Soda ile kaıştırmayalım :)',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'churchill.webp',
                'title' => 'Churchill',
                'price' => 70.00,
                'body' => 'Maden Suyu hiç böyle afilli olmamıştı. Fizz görüntüsüne içinler az değil.',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'monster.webp',
                'title' => 'Enerji Monster',
                'price' => 90.00,
                'body' => 'Sokak kültürüne ve gençlere destek veren bu enerji ürününe bizde destek veriyoruz. Tam bir fiyat performans ürünü. Ultra, Karpuz, Mango, Pipeline çeşitleri mevcuttur.',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'cheesecake.webp',
                'title' => 'Limonlu Cheesecake',
                'price' => 130.00,
                'body' => 'Cheesecake her zaman akıllardadır.',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'cheesecake.webp',
                'title' => 'Frambuazlı Cheesecake',
                'price' => 130.00,
                'body' => 'Cheesecake her zaman akıllardadır.',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'antep-fistikli-cikolatali-pasta.webp',
                'title' => 'Antep Fıstıklı Çikolatalı Pasta',
                'price' => 140.00,
                'body' => '',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'browni.webp',
                'title' => 'Brovnie Küp Kek',
                'price' => 100.00,
                'body' => 'Bitter Çikolatalı',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'cikolatali-tatli.webp',
                'title' => 'Çikolatalı Tatlı',
                'price' => 145.00,
                'body' => 'Tatlı ve çikolata beraber ilk akla gelen onlar menü de olmazsa olmaz.',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'kurabiye.webp',
                'title' => 'Bardak Kurabiye',
                'price' => 80.00,
                'body' => 'İçeceklerin yanında bir şey olsun isterim diyorsan Zeytinli, Çikolatalı, Glutensiz Hindistan Cevizli, Brovnili(20 lira fark var) 4 seçim olarak da elimizde bulunduruyoruz.',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'dondurma.webp',
                'title' => '3 Top Dondurma',
                'price' => 120.00,
                'body' => 'Sıcak mı havalar.... o  zaman  Don-Durma 90 gr',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'mono-latte-pasta.webp',
                'title' => 'Mono Latte Pasta',
                'price' => 135.00,
                'body' => '',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'kasarli-tost.webp',
                'title' => 'Kaşarlı Tost',
                'price' => 110.00,
                'body' => '',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'karisik.webp',
                'title' => 'Sucuklu Kaşarlı Tost',
                'price' => 120.00,
                'body' => '',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'jambonlu-sandivich.webp',
                'title' => 'Jambonlu Sandivich',
                'price' => 130.00,
                'body' => '',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => '3-peynirli.webp',
                'title' => '3 Peynirli Sandivich',
                'price' => 120.00,
                'body' => '',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'corn-flakes.webp',
                'title' => 'Corn Flakes Çeşitleri',
                'price' => 100.00,
                'body' => '',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'sipsevdi.webp',
                'title' => 'Şıpsevdi',
                'price' => 5.00,
                'body' => 'Arık retrolaşmış ve de şımarık reyonunda yerini almış eski tatlardan. Kasa önü satışı vardır.',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'topitop.webp',
                'title' => 'TopiTop',
                'price' => 20.00,
                'body' => 'Yalap çalap emzik niyetine .. Kasa önü satışı vardır.',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'haribo.webp',
                'title' => 'Haribo',
                'price' => 15.00,
                'body' => 'Arık retrolaşmış ve de şımarık reyonunda yerini almış  eski tatlardan. Kasa önü satışı vardır.',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'mabel.webp',
                'title' => 'Mabel',
                'price' => 25.00,
                'body' => '',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'wafer-master.webp',
                'title' => 'Wafer Master',
                'price' => 10.00,
                'body' => '',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'hanuta.webp',
                'title' => 'Hanuta',
                'price' => 45.00,
                'body' => '',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'hobby.webp',
                'title' => 'Hobby',
                'price' => 20.00,
                'body' => 'Arık retrolaşmış ve de şımarık reyonunda yerini almış eski tatlardan. Kasa önü satışı vardır.',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'tadelle.webp',
                'title' => 'Tadelle',
                'price' => 35.00,
                'body' => 'Arık retrolaşmış ve de şımarık reyonunda yerini almış  eski tatlardan. Kasa önü satışı vardır.',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'bahceden-fındıklı-bar.webp',
                'title' => 'Bahçeden Fındıklı Bar',
                'price' => 35.00,
                'body' => 'Sporcuları unutmadık acil set protein grubu. Kasa önü satışı vardır.',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'bahceden-fıstıklı-bar.webp  ',
                'title' => 'Bahçeden Fıstıklı Bar',
                'price' => 35.00,
                'body' => 'Sporcuları unutmadık acil set protein grubu. Kasa önü satışı vardır.',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'çokokrem.webp',
                'title' => 'Çokokrem',
                'price' => 45.00,
                'body' => 'Arık retrolaşmış ve de şımarık reyonunda yerini almış eski tatlardan. Kasa önü satışı vardır.',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'korumasız-deri-eldiven.webp',
                'title' => 'Korumasız Deri Eldiven',
                'price' => 1200.00,
                'body' => 'Bedenleri ve renkleri için reyonlara bakalım lütfen.',
                'category' => 'Aksesuarlar'
            ],
            [
                'thumbnail' => 'motowolf-korumalı-eldiven.webp',
                'title' => 'Motowolf Korumalı Eldiven',
                'price' => 2000.00,
                'body' => 'Bu üründe farklı modeller ve fiyatlar mevcut olup bedenleri ve renkleri için reyonlara bakalım lütfen.',
                'category' => 'Aksesuarlar'
            ],
            [
                'thumbnail' => 'rockbiker-motor-eldiven.webp',
                'title' => 'Rockbiker Motor Eldiven',
                'price' => 1600.00,
                'body' => 'Bu üründe farklı modeller ve fiyatlar mevcut olup bedenleri ve renkleri için reyonlara bakalım lütfen.',
                'category' => 'Aksesuarlar'
            ],
            [
                'thumbnail' => 'komine-motor-eldiven.webp',
                'title' => 'Komine Motor Eldiven',
                'price' => 1600.00,
                'body' => 'Bu üründe farklı modeller ve fiyatlar mevcut olup bedenleri ve renkleri için reyonlara bakalım lütfen.',
                'category' => 'Aksesuarlar'
            ],
            [
                'thumbnail' => 'icon-motor-eldiven.webp',
                'title' => 'Icon Motor Eldiven',
                'price' => 1750.00,
                'body' => 'Bu üründe farklı modeller ve fiyatlar mevcut olup bedenleri ve renkleri için reyonlara bakalım lütfen.',
                'category' => 'Aksesuarlar'
            ],
            [
                'thumbnail' => 'motor-ceket.webp',
                'title' => 'Motor Ceket',
                'price' => 13000.00,
                'body' => 'Bu üründe farklı modeller ve fiyatlar mevcut olup bedenleri ve renkleri için reyonlara bakalım lütfen.',
                'category' => 'Aksesuarlar'
            ],
            [
                'thumbnail' => 'motor-buff-r2l.webp',
                'title' => 'Motor Buff R2L',
                'price' => 250.00,
                'body' => 'Bu üründe farklı modeller ve fiyatlar mevcut olup bedenleri ve renkleri için reyonlara bakalım lütfen.',
                'category' => 'Aksesuarlar'
            ],
            [
                'thumbnail' => 'motor-buff.webp',
                'title' => 'Motor Buff',
                'price' => 150.00,
                'body' => 'Bu üründe farklı modeller ve fiyatlar mevcut olup bedenleri ve renkleri için reyonlara bakalım lütfen.',
                'category' => 'Aksesuarlar'
            ],
            [
                'thumbnail' => 'kot-yelek.webp',
                'title' => 'Kot Yelek',
                'price' => 1500.00,
                'body' => 'Bedenleri ve ürün çeşitleri mevcuttur. Ürünlerde farklı fiyatlar olabilir. Lütfen sorunuz.',
                'category' => 'Aksesuarlar'
            ],
            [
                'thumbnail' => 't-shirt.webp',
                'title' => 'T-Shirt',
                'price' => 400.00,
                'body' => 'Beden ve çeşitleri mevcuttur. Ürünlerde farklı fiyatlar olabilir. Lütfen sorunuz.',
                'category' => 'Aksesuarlar'
            ],
            [
                'thumbnail' => 'patch.webp',
                'title' => 'Patch',
                'price' => 80.00,
                'body' => 'Bu üründe farklı modeller ve fiyatlar mevcut olup renkleri için reyonlara bakalım lütfen.',
                'category' => 'Aksesuarlar'
            ],
            [
                'thumbnail' => 'biblo-motor.webp',
                'title' => 'Biblo Motor',
                'price' => 2000.00,
                'body' => 'Bu üründe farklı modeller ve fiyatlar mevcut olup renkleri için reyonlara bakalım lütfen.',
                'category' => 'Aksesuarlar'
            ],
            [
                'thumbnail' => 'sweatshirt.webp',
                'title' => 'Sweatshirt',
                'price' => 1000.00,
                'body' => 'Bu üründe farklı modeller ve fiyatlar mevcut olup bedenleri ve renkleri için reyonlara bakalım lütfen.',
                'category' => 'Aksesuarlar'
            ],
            [
                'thumbnail' => 'sırt-patch.webp',
                'title' => 'Sırt Patch',
                'price' => 300.00,
                'body' => 'Bu üründe farklı modeller ve fiyatlar mevcut olup bedenleri ve renkleri için reyonlara bakalım lütfen.',
                'category' => 'Aksesuarlar'
            ],
            [
                'thumbnail' => 'zippo.webp',
                'title' => 'Zippo',
                'price' => 300.00,
                'body' => 'Bu üründe farklı modeller ve fiyatlar mevcut olup renkleri için reyonlara bakalım lütfen.',
                'category' => 'Aksesuarlar'
            ],
        ];

        foreach ($products as $product) {
            $category = Category::firstOrCreate(['name' => $product['category']]);

            Product::create([
                'thumbnail' => $product['thumbnail'],
                'title' => $product['title'],
                'price' => $product['price'],
                'body' => $product['body'],
                'category_id' => $category->id,
            ]);
        }
    }
}
