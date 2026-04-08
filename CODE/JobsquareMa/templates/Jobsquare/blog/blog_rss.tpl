<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:atom="https://www.w3.org/2005/Atom" xmlns:content="https://purl.org/rss/1.0/modules/content/">
    <channel>
        <title>[[Blog]]</title>
        <link><![CDATA[{$GLOBALS.site_url}/blog/]]></link>
        <description></description>
        <language>{$GLOBALS.current_language}</language>
        <pubDate>{$smarty.now|date_format:'D, d M y H:i:s O'}</pubDate>
        <lastBuildDate>{$smarty.now|date_format:'D, d M y H:i:s O'}</lastBuildDate>
        <generator>SmartJobBoard</generator>
        <webMaster>{$GLOBALS.settings.system_email} ({$GLOBALS.settings.site_title})</webMaster>
        <atom:link href="{$GLOBALS.site_url}/blog/rss/" rel="self" type="application/rss+xml" />
        {foreach from=$posts item=post}
            <item>
                <title><![CDATA[{$post.title}]]></title>
                <link><![CDATA[{$GLOBALS.site_url}{$post|blog_url|escape}]]></link>
                <description><![CDATA[{$post.text|strip_tags|trim|truncate:255}]]></description>
                <content:encoded><![CDATA[{$post.text}]]></content:encoded>
                <pubDate>{$post.date|date_format:'D, d M y H:i:s O'}</pubDate>
                <guid><![CDATA[{$GLOBALS.site_url}{$post|blog_url|escape}]]></guid>
            </item>
        {/foreach}
    </channel>
</rss>
