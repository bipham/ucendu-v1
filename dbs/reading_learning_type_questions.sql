-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 04, 2017 lúc 09:39 CH
-- Phiên bản máy phục vụ: 10.1.21-MariaDB
-- Phiên bản PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ucendu`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reading_learning_type_questions`
--

CREATE TABLE `reading_learning_type_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_question_id` int(10) UNSIGNED NOT NULL,
  `title_section` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'fa-cog',
  `content_section` text COLLATE utf8_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reading_learning_type_questions`
--

INSERT INTO `reading_learning_type_questions` (`id`, `type_question_id`, `title_section`, `icon`, `content_section`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'OVERVIEW', 'fa-bandcamp', '<ul>\n	<li>Th&iacute; sinh được y&ecirc;u cầu điền ti&ecirc;u đề cho c&aacute;c đoạn văn được chia ra trong b&agrave;i IELTS Reading</li>\n	<li>Số lượng ti&ecirc;u đều lu&ocirc;n&nbsp;<b>NHIỀU HƠN</b>&nbsp;c&aacute;c đoạn văn</li>\n	<li>Ti&ecirc;u đề&nbsp;<b>KH&Ocirc;NG</b>&nbsp;được sắp xếp theo thứ tự đoạn văn</li>\n</ul>', 1, '2017-09-04 18:13:44', '2017-09-04 18:13:44'),
(2, 3, 'SKILLS', 'fa-wrench', '<ul>\n	<li>Skimming</li>\n	<li>Scanning</li>\n	<li>Synonyms (từ đồng nghĩa)</li>\n</ul>\n\n<p>(Đối với c&aacute;c kỹ năng n&agrave;y, c&aacute;c bạn gh&eacute; website của UCENDU.vn để thực h&agrave;nh nh&eacute;)</p>', 1, '2017-09-04 19:10:23', '2017-09-04 19:10:23'),
(3, 3, 'STRATEGY', 'fa-space-shuttle', '<p><b>1.&nbsp;</b><i>Gạch bỏ ti&ecirc;u đề đ&atilde; được dung l&agrave;m v&iacute; dụ:</i><br />\n- Kh&ocirc;ng phải b&agrave;i n&agrave;o cũng c&oacute; v&iacute; dụ, tuy nhi&ecirc;u nếu c&oacute; th&igrave; bạn n&ecirc;n gạch bỏ ti&ecirc;u đề đ&oacute; để đỡ bị rối l&uacute;c l&agrave;m b&agrave;i.<br />\n&nbsp;</p>\n\n<p><b>2.&nbsp;</b><i>Đọc c&aacute;c ti&ecirc;u đề trước &amp; x&aacute;c định từ kh&oacute;a</i><br />\n- Nắm nội dung của c&aacute;c ti&ecirc;u đề được đưa ra v&agrave; c&oacute; c&aacute;i nh&igrave;n tổng qu&aacute;t về nội dung b&agrave;i đọc.<br />\n&nbsp;</p>\n\n<p><b>3.&nbsp;</b><i>T&igrave;m c&acirc;u chủ đề (Topic Sentences):</i><br />\n- C&acirc;u chủ đề thường bắt đầu bằng c&aacute;c từ&nbsp;<b><i>But, Yet, The point is, Obviously, Overall, In reality, In general, The main point is, The truth is, Above all</i></b>, etc.<br />\n- C&acirc;u chủ đề sẽ n&oacute;i về &yacute; của đoạn đ&oacute;, c&acirc;u chủ đề thường l&agrave;:<br />\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + 1-2 C&acirc;u đầu<br />\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + 1-2 C&acirc;u cuối</p>\n\n<p><b>4.&nbsp;</b>Dự đo&aacute;n v&agrave; đưa ra lựa chọn<br />\n- Trong qu&aacute; tr&igrave;nh n&agrave;y, bạn dự đo&aacute;n đ&aacute;p &aacute;n n&agrave;o th&igrave; cứ ghi ra, nếu 1 đoạn m&agrave; c&aacute;c bạn chưa ph&acirc;n biệt được đ&aacute;p &aacute;n n&agrave;o m&agrave; ph&acirc;n v&acirc;n ở nhiều đ&aacute;p &aacute;n th&igrave; cứ ghi ra nh&eacute;, sau khi l&agrave;m xong tất cả c&aacute;c đoạn th&igrave; sẽ quay lại sửa tiếp.</p>', 1, '2017-09-04 19:11:48', '2017-09-04 19:11:48'),
(4, 3, 'TIPS', 'fa-cubes', '<p>C&aacute;c tips n&agrave;y kh&ocirc;ng ho&agrave;n to&agrave;n l&agrave; &ldquo;chuẩn mực&rdquo;. Đ&acirc;y l&agrave; phương ph&aacute;p được phần lớn c&aacute;c gi&aacute;o vi&ecirc;n cho &aacute;p dụng, tuy nhi&ecirc;n c&aacute;c bạn ho&agrave;n to&agrave;n c&oacute; thể điều chỉnh để ph&ugrave; hợp hơn với c&aacute;ch l&agrave;m b&agrave;i của m&igrave;nh nh&eacute;.</p>\n\n<ol>\n	<li><b><i>L&agrave;m dạng Matching Headings cuối c&ugrave;ng:</i></b><br />\n	Đ&acirc;y l&agrave; dạng b&agrave;i kh&aacute; kh&oacute;, đ&ograve;i hỏi khả năng đọc hiểu cũng như kỹ năng scanning &amp; skimming. Đối với bạn n&agrave;o c&oacute; khả năng đọc nhanh th&igrave; ho&agrave;n to&agrave;n c&oacute; thể l&agrave;m dạng b&agrave;i n&agrave;y trước. Đối với bạn n&agrave;o c&ograve;n yếu th&igrave; dạng n&agrave;y n&ecirc;n để sau</li>\n	<li><b><i>L&agrave;m từ đoạn n&agrave;o ngắn nhất trước:</i></b><br />\n	Điều n&agrave;y dễ hiểu l&agrave; v&igrave; c&aacute;c đoạn ngắn th&igrave; dễ đọc &ndash; dễ hiểu hơn. Tips n&agrave;y sẽ &aacute;p dụng cho bạn n&agrave;o chưa đọc m&agrave; v&agrave;o l&agrave;m lu&ocirc;n dạng b&agrave;i n&agrave;y nh&eacute;. Đối với bạn n&agrave;o đ&atilde; đọc v&agrave; l&agrave;m c&aacute;c dạng kh&aacute;c, sau đ&oacute; mới qua dạng n&agrave;y th&igrave; ho&agrave;n to&agrave;n c&oacute; thể l&agrave;m theo thứ tự, v&igrave; khi đ&oacute; c&aacute;c bạn đ&atilde; nắm được &yacute; ch&iacute;nh v&agrave; cấu tr&uacute;c của b&agrave;i rồi.</li>\n	<li><b><i>T&igrave;m từ đồng nghĩa:</i></b><br />\n	Kỹ năng n&agrave;y th&igrave; l&agrave; bắt buộc rồi, v&igrave; c&aacute;c từ trong c&aacute;c headings lu&ocirc;n l&agrave; c&aacute;c từ đồng nghĩa, c&aacute;c bạn cần phải t&igrave;m được c&aacute;c từ đồng nghĩa ở c&aacute;c đoạn chứa &yacute; đ&oacute;, c&oacute; như vậy th&igrave; qu&aacute; tr&igrave;nh l&agrave;m sẽ nhanh v&agrave; ch&iacute;nh x&aacute;c hơn nhiều.</li>\n	<li><b><i>Chuyển qua dạng / c&acirc;u kh&aacute;c nếu l&agrave;m m&atilde;i chưa xong:</i></b><br />\n	Matching Headings chưa bao giờ l&agrave; dễ đối với hầu hết c&aacute;c bạn, n&ecirc;n nếu c&aacute;c bạn chưa l&agrave;m xong m&agrave; tốn qu&aacute; 20 ph&uacute;t cho đoạn đ&oacute; th&igrave; h&atilde;y moving on liền nh&eacute;.</li>\n</ol>', 1, '2017-09-04 19:12:42', '2017-09-04 19:12:42'),
(5, 3, 'EXAMPLE', 'fa-life-ring', '<p><b><i>The Reading Passage has 4 paragraphs, A-D Choose the correct heading for each paragraph from the list of headings below Tea and the Industrial Revolution</i></b></p>\n\n<p><i>A cambride professor says that a change in drinking habits was the reason for the Industrial Revolution in Britain. Anjana Abuja reports</i></p>\n\n<p><b>A.</b>&nbsp;Alan Macfarlane, professor of anthropological science at King&rsquo;s College, Cambride, has, like other historians, spent decades wrestling with the enigma of the Industrial Revolution. Why did this particular Big Bang &ndash; the world changing birth of industry &ndash; happen in Britain? And why did it strike at the end of the 18th century?</p>\n\n<p><b>B.</b>&nbsp;Macfarlane compares the puzzle to a combination lock. &lsquo;There are about 20 different factors and all of them need to be present before the revolution can happen,&rsquo; he says. For industry to take off, there needs to be the technology and power to drive factories, large urband populations to provide cheap labour, easy transport to move goods around, an affluent middle-class willing to buy mass-produces objects, a market-driven economy and a political system that allows this to happen. While this was the case for England, other nations, such as Japan, the Netherlands and France also met some oss these criteria but were not industrializing. &lsquo;All these factors must have been necessary but not sufficient to cause the revolution,&rsquo; says Macfarlane. &lsquo;After all, Holland had everything except coal, while China also had many of these factors. Most historians are convinced there are one or two missing factors that you need to open the lock.&rsquo;</p>\n\n<p><b>C.</b>&nbsp;The missing factors, he proposes, are to be found in almost every kitchen cupboard. Tea and beer two of the nation&rsquo;s favourite drinks, fueled the revolution. the antiseptic properties of tannin, the active ingredient in tea, and of hops in beer &ndash; plus the fact that both are made with boiled water &ndash; allowed urban communities to flourish at close quarters withous succumbing to water-borne diseases such as dysentery. The theory sounds eccentric but once he starts to explain the detective work that went into his deduction, the skepticism gives way to wary admiration. Macfarlane&rsquo;s case has been strengthened by support from notable quarters &ndash; Roy Porter, the distinguished medical historian, recently wrote a favourable appraisal of his research.</p>\n\n<p><b>D.&nbsp;</b>Macfarlane had wondered for a long time how the Industrial Revolution came about. Historians had alighted on one interesting factor around the mid-18th century that required explanation. Between about 1650 and 1740, the population in Britain was static. But then there was a burst in population growth. Macfarlane says: &lsquo;The infant mortality rate halved in the space of 20 years, and this happened in both rural areas and cities, and across all classes. People suggested four possible causes. Was there a sudden change in the viruses and bacteria around? Unlikely. Was there a change in environmental conditions? There were improvements in agriculture that wiped out malaria, but these were small grains. Sanitation did not become widespread until the 19th century. The only option left is food. But the height and weight statistics show a decline. So the food must have got worse. Efforts to explain this sudden reduction in child deaths appeared to draw a blank.&rsquo;</p>\n\n<p>&nbsp;</p>\n\n<p>List of headings<br />\n<b>i.</b>&nbsp;The search for the reason for an increase in population<br />\n<b>ii.</b>&nbsp;The time and place of The Industrial Revolution<br />\n<b>iii.</b>&nbsp;The cases of Holland, France and China<br />\n<b>iv.</b>&nbsp;Comparisons with Japan lead to the answer<br />\n<b>v.</b>&nbsp;Two keys to Britain&rsquo;s Industrial Revolution<br />\n<b>vi.</b>&nbsp;Industrialization and the fear of unemployment<br />\nvii.&nbsp;Conditions required for Industrial Revolution</p>\n\n<p>&nbsp;</p>\n\n<p><b><i>C&Aacute;C BƯỚC L&Agrave;M B&Agrave;I CHI TIẾT:</i></b></p>\n\n<p><b>1. Đọc c&aacute;c ti&ecirc;u đề v&agrave; t&igrave;m từ kh&oacute;a</b></p>\n\n<p>- Ti&ecirc;u đề i: reason, increase in population- Ti&ecirc;u đề ii: time and place</p>\n\n<p>- Ti&ecirc;u đề iii: Holland, France, China</p>\n\n<p>- Ti&ecirc;u đề iv: Japan</p>\n\n<p>- Ti&ecirc;u đề v: two keys, Britain</p>\n\n<p>- Ti&ecirc;u đề vi: unemployment</p>\n\n<p>- Ti&ecirc;u đề vii: conditions required</p>\n\n<p>Cụm &ldquo;Industrial Revolution&rdquo; kh&ocirc;ng cần ch&uacute; &yacute; v&igrave; n&oacute; l&agrave; nội dung ch&iacute;nh được nhắc đi nhắc lại từ đầu đến cuối b&agrave;i.</p>\n\n<p><b>2. T&igrave;m c&acirc;u chủ đề hoặc đọc lướt c&aacute;c đoạn để nắm được nội dung ch&iacute;nh</b></p>\n\n<p><b>V&iacute; dụ:</b></p>\n\n<p>- Ở đoạn B, &yacute; ch&iacute;nh c&oacute; thể t&igrave;m được ở c&acirc;u thứ 2, cũng l&agrave; c&acirc;u chủ đề của đoạn,&nbsp;<i>&ldquo;<b>There are about 20 different factors and all of them need to be present before the revolution can happen</b>&rdquo;.&nbsp;</i>C&aacute;c c&acirc;u tiếp theo đ&oacute;ng vai tr&ograve; khai triển cụ thể c&aacute;c yếu tố v&agrave; c&aacute;c nước như&nbsp;<b><i>England, Japan, Netherlands, Holland v&agrave; China&nbsp;</i></b>được đưa v&agrave;o ở phần cuối đoạn như c&aacute;c dẫn chứng minh họa.</p>\n\n<p>- Ở đoạn D, c&acirc;u thứ 3 của đoạn đ&oacute;ng vai tr&ograve; như c&acirc;u n&ecirc;u l&ecirc;n chủ đề ch&iacute;nh cho cả đoạn (c&acirc;u chủ đề vị tr&iacute; giữa đoạn), đứng sau cụm &ldquo;but then&rdquo;,&nbsp;<i>&ldquo;<b>But then there was a burst in population growth</b>&rdquo;.&nbsp;</i>Cho n&ecirc;n đoạn n&agrave;y sẽ tập trung mi&ecirc;u tả giải th&iacute;ch c&aacute;c nguy&ecirc;n nh&acirc;n dẫn đến việc tăng d&acirc;n số (khi kết hợp th&ecirc;m với từ &ldquo;explanation&rdquo; ở c&acirc;u 2). C&aacute;c c&acirc;u c&ograve;n lại của cả đoạn đ&oacute;ng vai tr&ograve; ph&acirc;n t&iacute;ch cụ thể c&aacute;c nguy&ecirc;n nh&acirc;n.</p>\n\n<p>&nbsp;</p>\n\n<p><b>3. Dự đo&aacute;n/x&aacute;c định c&aacute;c từ đồng nghĩa hoặc mang nghĩa tương đương giữa c&aacute;c ti&ecirc;u đề v&agrave; c&acirc;u chủ đề ở c&aacute;c đoạn v&agrave; chọn đ&aacute;p &aacute;n:</b></p>\n\n<p><b>V&iacute; dụ</b></p>\n\n<p>- Ở đoạn A c&oacute; 2 c&acirc;u hỏi với &ldquo;Why&rdquo;. C&acirc;u hỏi thứ nhất đề cập đến&nbsp;<i>&ldquo;happen in Britain&rdquo;&nbsp;</i>chỉ yếu tố nơi chốn, tương ứng với &ldquo;where&rdquo; . C&acirc;u hỏi thứ hai đề cập&nbsp;<i>&ldquo; at the end of the 18th century&rdquo;&nbsp;</i>chỉ yếu tố thời gian, tương ứng với&rdquo; when&rdquo; =&gt;&nbsp;<b><i>Đoạn A sẽ tương ứng với heading ii</i></b></p>\n\n<p>- Ở đoạn B, trong c&acirc;u chủ đề (c&acirc;u thứ 2) c&oacute; cụm&nbsp;<i>&ldquo; factors&hellip;need to be present&hellip;&rdquo;&nbsp;</i>tương ứng với&nbsp;<i>&ldquo;conditioned required&rdquo;&nbsp;</i>trong ti&ecirc;u đề =&gt; &nbsp;<b><i>Đoạn B sẽ tương ứng với heading vii</i></b><br />\n- Ở đoạn C, trong c&acirc;u chủ đề ( c&acirc;u thứ 2) c&oacute; cụm&nbsp;<i>&ldquo; tea and beer, two of the&hellip;&rdquo;&nbsp;</i>tương ứng với &ldquo;two keys&rdquo; trong ti&ecirc;u đề =&gt;&nbsp;<b><i>Đoạn C sẽ tương ứng với heading v</i></b></p>\n\n<p>- Ở đoạn D, trong c&acirc;u chủ đề c&oacute; &lsquo;population growth&rdquo; kết hợp với từ &ldquo;explanation&rdquo; trong c&acirc;u trước đ&oacute;, tương ứng với &ldquo;reason&rdquo; v&agrave; &ldquo;population growth&rdquo; trong ti&ecirc;u đề<br />\n=&gt;&nbsp;<b><i>Đoạn D sẽ tương ứng với heading i</i></b></p>', 1, '2017-09-04 19:13:48', '2017-09-04 19:13:48');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `reading_learning_type_questions`
--
ALTER TABLE `reading_learning_type_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reading_learning_type_questions_type_question_id_foreign` (`type_question_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `reading_learning_type_questions`
--
ALTER TABLE `reading_learning_type_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `reading_learning_type_questions`
--
ALTER TABLE `reading_learning_type_questions`
  ADD CONSTRAINT `reading_learning_type_questions_type_question_id_foreign` FOREIGN KEY (`type_question_id`) REFERENCES `reading_type_questions` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
