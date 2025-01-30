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
                'price' => 115.00,
                'body' => 'Espresso yu asortize edikceksek ve de alışmayan bünyelere sevdireceksek ona da internet dilinde bir kulp takıcaksak "Şukela" yeterli olur sanırsak',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'espresso-ristretto.webp',
                'title' => 'Espresso Ristretto',
                'price' => 90.00,
                'body' => 'İlk damlalar kahvenin en yoğun geldiği damlalar olduğu için konsantre bir lezzet vardır. Akış miktarı arttıkça başlıktan gelen kahve yoğunluğu giderek düşer. İşte bu ilk yudumları daha çok seven İtalyanlar double espresso\'yu 40ml su ile hazırlayarak buna kısıtlı anlamına gelen ristretto ismini vermişler. Aynı miktarda kahve ve daha az suyla hazırlandığı için daha yoğun bir lezzete sahip olan ristretto özellikle sabah uyanmak için birebir. Günümüzün Türçe  tabiriyle İngilazca konuşan bünyelerin  "bir quickie" siparişidir.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'espresso-single.webp',
                'title' => 'Espresso Single',
                'price' => 90.00,
                'body' => 'Temelde" espresso, demleme yöntemine verilen ad. Espresso makinesinde demlenen kahvenin adı espresso oluyor. Özelliği ise, kahveyi 30 sn gibi kısa bir sürede, yaklaşık 9 bar basınç ile suyu kahvenin içerisinden geçirmek suretiyle demlemesi. Bu yöntemle kahvenin içerisindeki tüm yağlar ve asitler de bardağa aktarılıyor. Kahve terminolojisine biz de imza atalım dersek  " kurşun asker " diyebiliriz.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'affogato.webp',
                'title' => 'Affogato',
                'price' => 130.00,
                'body' => 'Sıcak ve soğuğu aynı anda sunan lezzetli bir kahve.  Espresso\'nun sertliği, dondurma ile azaltıldığı için yumuşak bir içimi vardır. Siz farklısını söylemezseniz vanilyalı dondurmayla servis ediliyor.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'espresso-decaf.webp',
                'title' => 'Espresso Decaf',
                'price' => 115.00,
                'body' => 'Bir shot espresso genellikle zihni uyandırırmak içindir ve bu nedenle birinin shot espressosu olmak, onun ruh halini bir ton yükselttiğiniz anlamına gelir.  Underground olarak sizin için asansör etkisinde robusta ve arabica\'nın kalitesini harmanlayarak yoğun bir tat ve güçlü içim kahve deneyimi sunar. Kafeinsiz karakteristik tatları sevenler için mükemmel seçim.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'cafe-miel.webp',
                'title' => 'Cafe Miel',
                'price' => 135.00,
                'body' => 'Yumuşak içimli  bal, süt,  espresso denklemine adının anlamı gibi  bir masal havası vaat ediyor.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'espresso-doppio.webp',
                'title' => 'Espresso Doppio',
                'price' => 110.00,
                'body' => 'Yoğun bir kıvama ve sert bir tada sahiptir. 60 ml basınçlandırılan su ile espresso çekirdeğinin hamam sefasıdır.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'espresso-lungo.webp',
                'title' => 'Espresso Lungo',
                'price' => 115.00,
                'body' => 'Bir shot espresso genellikle zihni uyandırırması içindir,bu nedenle birinin shot espressosu olmak, onun ruh halini bir ton yükselttiğiniz anlamına gelir.  Underground Coffee Shop  sizin için asansör etkisinde robusta ve arabica\'nın kalitesini harmanlayarak yoğun bir tat ve güçlü içim kahve deneyimi sunar. Karakteristik tatları sevenler için mükemmel seçim. Lungo sevenler için espresso yanında sıcak su servis ediyoruz istediğiniz yumuşaklığa karar verebilmeniz için',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'espresso-macchiato.webp',
                'title' => 'Espresso Macchiato',
                'price' => 110.00,
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
                'price' => 165.00,
                'body' => 'Kahve ile çikolatanın  valsi olabilir, ...',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'filtre-kahve.webp',
                'title' => 'Filtre Kahve',
                'price' => 120.00,
                'body' => 'Filtre kahve, öğütülmüş kahve çekirdeklerinin sıcak suyla buluşturulup demlenmesi sonucu elde edilen kahve çeşididir. Genel olarak farklı tipte ürün skalaları fanatiklerini de oluşturmuştur. Underground olarak karakteristik ve gövdeli kahve deneyimi sunarken kahve adına dip not bilgiler vermek gerekirse yağ yakıcıdır, diyabet kontrolüne destek verir, Alzheimer önleyici olup tam bir antioksidan deposudur demek yeterli olur şimdilik.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'decaf-filtre-kahve.webp',
                'title' => 'Decaf Filter Coffee',
                'price' => 135.00,
                'body' => '"Decaf" olarak da adlandırılan bu içecek aslında tamamen kafeinsiz değildir çünkü kafein, bitkinin kendisinde ve çekirdeklerinde doğal olarak bulunur ve Kafeinsiz kahve çeşitleri ise normale göre yaklaşık olarak %97 oranında daha az kafein içerir.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'mocha-cesitleri.webp',
                'title' => 'Mocha Çeşitleri',
                'price' => 165.00,
                'body' => 'Mocha için hangi stil size ait ...Caramel, Ruby, Lotus, Vanilya, Çikolata',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'cappucino.webp',
                'title' => 'Cappucino',
                'price' => 155.00,
                'body' => 'Genel haliyle tanımlayacak olursak dünya çapında oldukça popüler olan cappuccino, kuvvetli buharda demlenmiş süt köpüğü ile hazırlanan espresso bazlı bir kahve türüdür. Rivayete göre cappuccino kahvesine adını veren olay; Capuchin rahiplerinin kıyafetlerinin, cappuccino kahvesine benzetilmesinden gelmektedir.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'cortado.webp',
                'title' => 'Cortado',
                'price' => 135.00,
                'body' => 'İspanyolca da Cortado, kahvenin sütle kesildiği anlamına gelen kesme anlamına gelir . Cortado kahvesi, eşit miktarda espresso ve buharda pişirilmiş sütten yapılır.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'flat-white.webp',
                'title' => 'Flat White',
                'price' => 140.00,
                'body' => 'Latte den daha az süt ile yapılan zamanının beceriksiz Avusturalya\'lı baristanın çıkardığı icat diyelim. Genellikle gün ortasında içilen latteye göre daha çok espresso tadı alınabilen içecektir.  ',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'latte-macchiato.webp',
                'title' => 'Latte Macchiato',
                'price' => 150.00,
                'body' => 'Kademeli görünümüyle özel zevklerim var demenin kahvedeki klasik yolu.... Esmer şeker ile  her zaman favori..',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'underground-latte.webp',
                'title' => 'Underground Latte',
                'price' => 165.00,
                'body' => 'Underground olarak İmza ürün olarak illaki bir şeyler düşündük. Tropik -kabuklu kombinasyonu tabiki de süt ve espresso deneyin deriz.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'cafe-latte.webp',
                'title' => 'Cafe Latte',
                'price' => 145.00,
                'body' => 'Klasiktir pek tarif istemez sanırsak. Kahve kültürü olmayanların zamanında kedi sahibi bir kadının dükkanı diye düşündürten ismi ile  hala  İtalyan Güzeli',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'latte-cesitleri.webp',
                'title' => 'Latte Çeşitleri',
                'price' => 160.00,
                'body' => 'Latte sütün bol olduğu içecek anlamı verirken bunu kendi zevkine göre özelleştirmek isteyen tarzını belirlesin. Seçenekler : Fındık, Vanilya, Hind Ceviz, Karamel, Ruby, Balkabağı, Lotus, Bitter, ',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'americano.webp',
                'title' => 'Kafeinsiz Americano',
                'price' => 115.00,
                'body' => 'Americano, bir Espresso’nun sıcak su ile seyreltilmesiyle yapılır. Ne kadar sıcak su kullanılacağına dair özel bir kılavuz yoktur. Bazı insanlar 1:2 Espresso su oranının "standart" bir Americano olduğunu iddia ederken, diğerleri 1:1 oranlı bir Americano\'yu tercih eder. Gerçekte kahve dükkanları, Espressolarının yoğunluğuna ve müşterilerin damak zevkine bağlı olarak 1:15\'e kadar yüksek bir oran kullanabilir. Espresso sertliğine alışık olmayan bünyeler için daha yumuşak bir deneyim olup Amerikano nun afilli ismine bakıp Amerikancı bünyeleri hayal kırıklığına uğratmayacağımıza emin olabilirsiniz.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'ice-americano.webp',
                'title' => 'Ice Americano',
                'price' => 140.00,
                'body' => 'Bu amerikalılar ve tabiki bizim amarikancılar işi gene sulandırmış. Merak etmeyin kahvesini güçlü yapıyoruz paranızın sonuna kadar kahvesini de siz kalkana kadar masada bırakıyoruz.',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'ice-filter.webp',
                'title' => 'Ice Filter',
                'price' => 140.00,
                'body' => 'Filtre Kahvemi buzlu içmeyi severim diyenler için',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'ice-latte.webp',
                'title' => 'Ice Latte',
                'price' => 160.00,
                'body' => 'Lattenin cooler formu olup kahve ve sütün inanılmaz dansı herkesi büyülemiştir.',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'aromali-ice-latte.webp',
                'title' => 'Aromalı Ice Latte',
                'price' => 175.00,
                'body' => 'Sütlü, buzlu,  kahveli olan bu denkleme istediğiniz aroma ile şenlendirin Ruby, Karamel, Hindistan Ceviz, Lotus, Vanilya, Beyaz Çik, Bitter, Fındık, Bal Kabak, Irish Cream vb..',
                'category' => 'Soğuk İçecekler'
            ],
            // [
            //     'thumbnail' => 'ice-mocha.webp',
            //     'title' => 'Ice Mocha',
            //     'price' => 180.00,
            //     'body' => 'Mocha ile ilgili bildiğiniz herşeyi cooler modunda tüketmek için birebir. Çikolata, espresso, süt ün göz kırpışı diyelim romantizme de hizmet etmiş olallım.',
            //     'category' => 'Soğuk İçecekler'
            // ],
            [
                'thumbnail' => 'ice-mocha-cesitleri.webp',
                'title' => 'Ice Mocha Çeşitleri',
                'price' => 180.00,
                'body' => 'Mocha nın ruhu bu aromalarla yeniden tasarlandı. Araba gibi düşünün ve modele siz karar verin... Ruby, Karamel, Hindistan Ceviz, Lotus, Vanilya, Beyaz Çik, , Fındık, Irish Cream',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'frappe.webp',
                'title' => 'Frappe',
                'price' => 170.00,
                'body' => 'Yunanistan\'dan dünya yayılan serinlik. Granül kahvenin bu kadar yol alabileceğini kim bilebilirdi.',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'frappe-cesitleri.webp',
                'title' => 'Frappe Çeşitleri',
                'price' => 170.00,
                'body' => 'Fındıklı, Çikolatalı, Vanilyalı, Karamelli, Hindistan Cevizli, Irish Cream',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'ice-underground.webp',
                'title' => 'Ice Underground',
                'price' => 185.00,
                'body' => 'Bu üründe de biz kendi dokunuşunuzu yaptık. Underground ruhuna tropik ve toprak dengesi öneriyoruz. Sunumu da hiç fena değil diyorlar.',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'iced-chai-tea-latte.webp',
                'title' => 'Iced Chai Tea Latte',
                'price' => 170.00,
                'body' => 'Tarçın, baharatlar, siyah çay ve şekerin, buharda ısıtılmış süt ve süt köpüğü ile egzotik birleşimi. Son dönemlerin enteresan tercihlerinden . Farklı şeyler denemeye hazır olanların bolca tercih ettiği bir ürün oldu',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'iced-matcha-latte.webp',
                'title' => 'Iced Matcha Latte',
                'price' => 165.00,
                'body' => 'Buzlu içeceklerde seçiminiz deneysel olarak kahve, süt ve bitkisel aromalar üzerine olacaksa son dönemlerdeki yenilik arayanların favorisi olarak menümüzde yerini aldı. ',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'ice-chocolate.webp',
                'title' => 'Ice Chocolate',
                'price' => 180.00,
                'body' => 'Hem serin hem uzun içim hem de şeker patlması olsun ama bayılmamam lazım diyenlerin fantazisidir. Aslında ismi gibi de erotik bir tat. Siz sadece aromasını belirleyin gerisi bizde. Ruby, Caramel, Vanilya, Beyaz Çikolata, Beyaz Çikolata, Lotus',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'iced-salepso.webp',
                'title' => 'Iced Salepso',
                'price' => 185.00,
                'body' => 'Espresoo ve sahlep için uzun serin formu',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'ice-latte.webp',
                'title' => 'Iced Cappuccino',
                'price' => 165.00,
                'body' => 'Sütle yapılan soğuk içecek, ferahlamak isteyenler için birebir',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'espresso.webp',
                'title' => 'Iced Espresso',
                'price' => 120.00,
                'body' => 'Soğuk ve dinç kalmak isteyenler için',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'chai-tea-latte.webp',
                'title' => 'Chai Tea Latte',
                'price' => 150.00,
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
                'thumbnail' => 'sicak-cikolata.webp',
                'title' => 'Sıcak Çikolata Çeşitleri',
                'price' => 175.00,
                'body' => 'Yoğunluğu arttıkça, tadı da bağıl olarak muhteşemleşen, ılıkken de süper olan, müthiş içecek. Sizin seçiminiz ne ? Çikolata, Beyaz Çikolata, Ruby, Lotus, Karamel ...',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'salep.webp',
                'title' => 'Salep',
                'price' => 160.00,
                'body' => 'Kış dönemi için tüm zamanlarda sevdiğimiz bu içecek Antik Roma döneminde de bilinen ve tüketilen salep içeceği, Anadolu orkidesinin toprak altındaki yumrularından sağlanan tozdan elde edilir. Iskalamayın ve gönül rahatlığıyla sipariş verin porsiyon ve tat garantili.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'turk-kahvesi.webp',
                'title' => 'Türk Kahvesi',
                'price' => 100.00,
                'body' => 'Bildiğimiz bir ritüel siz sadece şekerine karar veriniz nostaljik leblebi şeker vermeyi unutmadık suyu da detoxxxx  ... Otantik tripler bunlar ama elimizden geldiğince ayarı verdik.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'double-turk-kahvesi.webp',
                'title' => 'Double Türk Kahvesi',
                'price' => 150.00,
                'body' => 'Bildiğimiz bir ritüel siz sadece şekerine karar veriniz nostaljik leblebi şeker vermeyi unutmadık suyu da detoxxxx  ... Otantik tripler bunlar ama elimizden geldiğince ayarı verdik.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'menengiç-kahvesi.webp',
                'title' => 'Menengiç Kahvesi',
                'price' => 110.00,
                'body' => 'Sakız ağacıgillerden bir meyve olan menengicin  kremsi muhteşemliğin süt veya suyla karıştırılarak içimi hoş bir içecek haline getirilmişi olup menengiç kahve gibi nikotin ve kafein içermediği için acı olmaz.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'double-menengiç-kahvesi.webp',
                'title' => 'Double Menengiç Kahvesi',
                'price' => 160.00,
                'body' => 'Sakız ağacıgillerden bir meyve olan menengicin  kremsi muhteşemliğin süt veya suyla karıştırılarak içimi hoş bir içecek haline getirilmişi olup menengiç kahve gibi nikotin ve kafein içermediği için acı olmaz.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'meyveli-cay.webp',
                'title' => 'Meyveli Çaylar',
                'price' => 50.00,
                'body' => 'Nostaljide kalan günlerimize dair büyüklerimizle çay bahçede ya da pasaj da han aralarında bize hitap edebilen naciz şımarık içecekleri hala sevenler için..ELma, Muz, Kivi, Portakal, Limon,',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'organic-cay.webp',
                'title' => 'Organic Çaylar',
                'price' => 115.00,
                'body' => 'Organikçileri ve mevsimsel alışkanlıkları unutmadık.  Bahçeden diyerek abartı olabilir ama abla tezgahta bunlar var şu an dediklerimiz...Atom Kış Çayı, Hibisküs, Ihlamur, Adaçayı, Kuşburnu, Yeşil Çay, Rezene, Papatya, Melisa',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'fincan-cay.webp',
                'title' => 'Fincan Çay',
                'price' => 60.00,
                'body' => 'Çay da ekonomi bu ürünle mümkün :)',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'take-away-cay.webp',
                'title' => 'Take Away Çay',
                'price' => 80.00,
                'body' => 'Karton bardakta al-götür çay',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'pot-cay.webp',
                'title' => 'Pot Çay',
                'price' => 170.00,
                'body' => 'Kalabalıksak ve de mutlaka 2. içerim diyorsak ama çarpılmasak da diyorsak seçim bu. 6 ince belli bardak servisi alabilirsiniz.',
                'category' => 'Sıcak İçecekler'
            ],
            [
                'thumbnail' => 'milkshake.webp',
                'title' => 'Milkshake Çeşitleri',
                'price' => 175.00,
                'body' => 'Milkshake süt, kırılmış buz, çeşitli meyvelerin karışımından oluşan serinletici ve tatlı ihtiyacını anında kesen harika bir içecek!  Vanilya, Çikolata, Caramel, Orman Meyve, Muz, Lotus, Çilek, Frambuaz, Ananas,Mango, Yeşil Elma, Passion Fruit',
                'category' => 'Mocktailler'
            ],
            [
                'thumbnail' => 'smoothie.webp',
                'title' => 'Smoothie Çeşitleri',
                'price' => 185.00,
                'body' => 'Smoothie, taze meyve ve sebzelerin sıkılmasıyla hazırlanan bir içecektir. Özellikle diyet yapanlar ve sporcular tarafından sık sık tüketilir. Çeşitleri için sorunuz lütfen',
                'category' => 'Mocktailler'
            ],
            [
                'thumbnail' => 'frozen.webp',
                'title' => 'Frozen Çeşitleri',
                'price' => 180.00,
                'body' => 'Ferahlık veren ve anında serinlemeyi mümkün kılan içeceklerden bir tanesi frozen olarak biline içeceklerdir. Buzlu meyveler kullanılarak hazırlanan frozen çok farklı alternatiflere de sahiptir. Çilekli, Orman Meyveli, Frambuaz, Yeşil Elma, Kavun, Karpuz, Mango, Karadut, Passion Fruit,Ananas',
                'category' => 'Mocktailler'
            ],
            [
                'thumbnail' => 'milkshake.webp',
                'title' => 'Mocktail Çeşitleri',
                'price' => 170.00,
                'body' => 'Mocktaillerin cesitleri de francis, carter, rodman, O\'neal ve Kemp.',
                'category' => 'Mocktailler'
            ],
            [
                'thumbnail' => 'limonata.webp',
                'title' => 'Limonata',
                'price' => 120.00,
                'body' => 'Yazlardan kalma bir alışkanlık  Freshhhhhhhhh',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'portakal.webp',
                'title' => 'Taze Portakal Suyu',
                'price' => 155.00,
                'body' => 'Tüm zamanların favorisi',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'coca-cola.png',
                'title' => 'Coca Cola',
                'price' => 90.00,
                'body' => 'Kahve ve çay tarzı bir şey içmek istemeyenleri için alternatif bulunduruyoruz',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'cola-zero.webp',
                'title' => 'Coca Cola Zero',
                'price' => 90.00,
                'body' => 'Şekersiz seçim.',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'beyoglu-gazozu.webp',
                'title' => 'Beyoğlu Gazoz',
                'price' => 90.00,
                'body' => 'Beyoğlu ismiyle beraber zaten UNDERGROUND, marka çatımız altında çok severek bulunduruyoruz ve sıkı içicileriyiz size de öneriririz.',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'beyoglu-zencefil.webp',
                'title' => 'Zencefilli Gazoz',
                'price' => 90.00,
                'body' => 'Doğal zengin mineralli sudan yapılan bu ürün gizli fanatiklerini bekliyor.',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'su.webp',
                'title' => 'Su',
                'price' => 40.00,
                'body' => 'pH : 7,5 .. Bu değeri aradık açıkçası',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'maden-suyu.webp',
                'title' => 'Maden Suyu',
                'price' => 75.00,
                'body' => 'Soda ile kaıştırmayalım :)',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'churchil.webp',
                'title' => 'Churchill',
                'price' => 100.00,
                'body' => 'Maden Suyu hiç böyle afilli olmamıştı. Fizz görüntüsüne içinler az değil.',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'monster.webp',
                'title' => 'Enerji Monster',
                'price' => 100.00,
                'body' => 'Sokak kültürüne ve gençlere destek veren bu enerji ürününe bizde destek veriyoruz. Tam bir fiyat performans ürünü. Ultra, Karpuz, Mango, Pipeline çeşitleri mevcuttur.',
                'category' => 'Soğuk İçecekler'
            ],
            [
                'thumbnail' => 'limonlu.png',
                'title' => 'Limonlu Cheesecake',
                'price' => 135.00,
                'body' => 'Cheesecake her zaman akıllardadır.',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'frambuazli.jpg',
                'title' => 'Frambuazlı Cheesecake',
                'price' => 135.00,
                'body' => 'Cheesecake her zaman akıllardadır.',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'antep-fistikli-cikolatali-pasta.webp',
                'title' => 'Antep Fıstıklı Çikolatalı Pasta',
                'price' => 155.00,
                'body' => '',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'browni.webp',
                'title' => 'Brovnie Küp Kek',
                'price' => 120.00,
                'body' => 'Bitter Çikolatalı',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'cikolatali-tatli.webp',
                'title' => 'Çikolatalı Tatlı',
                'price' => 160.00,
                'body' => 'Tatlı ve çikolata beraber ilk akla gelen onlar menü de olmazsa olmaz.',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'kurabiye.webp',
                'title' => 'Bardak Kurabiye',
                'price' => 105.00,
                'body' => 'İçeceklerin yanında bir şey olsun isterim diyorsan Zeytinli, Çikolatalı, Glutensiz Hindistan Cevizli, Brovnili(20 lira fark var) 4 seçim olarak da elimizde bulunduruyoruz.',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'dondurma.webp',
                'title' => '3 Top Dondurma',
                'price' => 130.00,
                'body' => 'Sıcak mı havalar.... o  zaman  Don-Durma 90 gr',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'mono-latte-pasta.webp',
                'title' => 'Mono Latte Pasta',
                'price' => 150.00,
                'body' => '',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'kasarli-tost.webp',
                'title' => 'Çift Kaşarlı Tost',
                'price' => 130.00,
                'body' => '',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'karisik.webp',
                'title' => 'Sucuklu Kaşarlı Tost',
                'price' => 145.00,
                'body' => '',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'jambonlu-sandivich.webp',
                'title' => 'Jambonlu Kaşarlı Sandivich',
                'price' => 120.00,
                'body' => 'Soğuk sandivich',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => '3-peynirli.webp',
                'title' => '3 Peynirli Sandivich',
                'price' => 120.00,
                'body' => 'Soğuk sandivich',
                'category' => 'Atıştırmalıklar'
            ],
            [
                'thumbnail' => 'sipsevdi.jpg',
                'title' => 'Şıpsevdi Sakız',
                'price' => 10.00,
                'body' => 'Arık retrolaşmış ve de şımarık reyonunda yerini almış eski tatlardan. Kasa önü satışı vardır.',
                'category' => 'Abur Cuburlar'
            ],
            [
                'thumbnail' => 'haribo.jpg',
                'title' => 'Haribo',
                'price' => 25.00,
                'body' => 'Arık retrolaşmış ve de şımarık reyonunda yerini almış  eski tatlardan. Kasa önü satışı vardır.',
                'category' => 'Abur Cuburlar'
            ],
            [
                'thumbnail' => 'big-babol.webp',
                'title' => 'Big Babol',
                'price' => 35.00,
                'body' => 'Arık retrolaşmış ve de şımarık reyonunda yerini almış  eski tatlardan. Kasa önü satışı vardır.',
                'category' => 'Abur Cuburlar'
            ],
            [
                'thumbnail' => 'tadelle.jpg',
                'title' => 'Tadelle',
                'price' => 45.00,
                'body' => 'Arık retrolaşmış ve de şımarık reyonunda yerini almış  eski tatlardan. Kasa önü satışı vardır.',
                'category' => 'Abur Cuburlar'
            ],
            [
                'thumbnail' => 'cokokrem.jpg',
                'title' => 'Çokokrem',
                'price' => 80.00,
                'body' => 'Arık retrolaşmış ve de şımarık reyonunda yerini almış eski tatlardan. Kasa önü satışı vardır.',
                'category' => 'Abur Cuburlar'
            ],
            [
                'thumbnail' => 'korumasız-deri-eldiven.webp',
                'title' => 'Korumasız Deri Eldiven',
                'price' => 1200.00,
                'body' => 'Bedenleri ve renkleri için reyonlara bakalım lütfen.',
                'category' => 'Aksesuarlar'
            ],
            [
                'thumbnail' => 'motowolf-korumali-eldiven.webp',
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
                'thumbnail' => 'biblo.webp',
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
            [
                'thumbnail' => 'laktozsuz-sut.webp',
                'title' => 'Laktozsuz Süt',
                'price' => 30.00,
                'body' => 'Extra tercih veyahut ürünlerin hazırlanmasında tercih edilirse eklenir.',
                'category' => 'Ekstralar'
            ],
            [
                'thumbnail' => 'vegan-sut.webp',
                'title' => 'Vegan Süt',
                'price' => 30.00,
                'body' => 'Extra tercih veyahut ürünlerin hazırlanmasında tercih edilirse eklenir.',
                'category' => 'Ekstralar'
            ],
            [
                'thumbnail' => 'espresso.webp',
                'title' => 'Espresso',
                'price' => 30.00,
                'body' => 'Extra tercih veyahut ürünlerin hazırlanmasında tercih edilirse eklenir.',
                'category' => 'Ekstralar'
            ],
            [
                'thumbnail' => 'bal.webp',
                'title' => 'Bal',
                'price' => 30.00,
                'body' => 'Extra tercih veyahut ürünlerin hazırlanmasında tercih edilirse eklenir.',
                'category' => 'Ekstralar'
            ],
            [
                'thumbnail' => 'aroma.webp',
                'title' => 'Aroma',
                'price' => 30.00,
                'body' => 'Extra tercih veyahut ürünlerin hazırlanmasında tercih edilirse eklenir.',
                'category' => 'Ekstralar'
            ],
            [
                'thumbnail' => 'paket-espresso.webp',
                'title' => 'Lugano Espresso 1kg',
                'price' => 850.00,
                'body' => 'Strong Kahve Çekirdeği 1 Kg Lugano Caffé, espressonun başkenti olan İtalya’da kurulmuştur ve yıllardır milyarlarca fincan İtalyan espressosunu müşterilerine sunmaktadır.Markamız, İtalyan cazibesinin ve İsviçre hassasiyetinin birleştiği, güzellik ve meydan okuma anlamlarına gelen Lugano şehrinden ilham alarak tüm dünyada İtalyan kahve sevdalılarına espressonun orijinal tadını sunacak bir elçi görevi görmektedir. Robusta ve Arabica’nın kalitesini harmanlayarak yoğun bir tat ve orta içim kahve deneyimi sunar.Karakteristik tatları sevenler için mükemmel seçim.tam kıvamlı ve güçlü aromalı espresso kahve karışımı.Kahve çekirdeği yağlarının orijinal tadını korumak için düşük kavurma derecesi ile ayırt edilir. 1000 gr. Kahve Ambalajında.',
                'category' => 'Ekstralar'
            ],
            [
                'thumbnail' => 'paket-filtre-kahve.webp',
                'title' => 'Paketli Filtre Kahve 250gr',
                'price' => 180.00,
                'body' => 'Lugano Strong Öğütülmüş Filtre Kahve 250 gr Vakum Paket',
                'category' => 'Ekstralar'
            ],
            [
                'thumbnail' => 'kafeinsiz-filtre-kahve.webp',
                'title' => 'Kafeinsiz Filtre Kahve 250gr',
                'price' => 250.00,
                'body' => 'Kuru kahveci Mehmet Efendi Guatemala Filitre Kahve 250gr',
                'category' => 'Ekstralar'
            ],
            [
                'thumbnail' => 'kafeinsiz-ogutulmus-espresso-cekirdek.webp',
                'title' => 'Kafeinsiz Öğütülmüş Espresso Çekirdek 250gr',
                'price' => 280.00,
                'body' => 'Filtre kahve makinesi, french press ve moka pot ile kullanabilirsiniz. Kolombiya\'nın yüksek tarım alanlarında yetişen ve özenle toplanan kahve çekirdekleri, öğütülmüş ve kafeinden arındırılmıştır. Zengin lezzetli ve dolgun aromalı, kafeinsiz bir kahve keyfi arzuluyorsanız Exclusive Decaf\'ı tercih edin.',
                'category' => 'Ekstralar'
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
