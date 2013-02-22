<rss version="2.0">
    <channel>
        <title>Webtuts</title>
        <link>http://webtuts.fr</link>
        <description>Les tutoriaux Webtuts</description>
<?php foreach ($params as $article) { ?>
        <item>
            <title><?php echo $article["title"]; ?></title>
            <link>http://webtuts.fr<?php echo $article["link"]; ?></link>
            <guid isPermaLink="True"><?php $article["guid"]; ?></guid>
            <description><?php echo $article["description"]; ?></description>
            <pubDate><?php echo $article["date"]; ?></pubDate>
        </item>
<?php } ?>
    </channel>
</rss>