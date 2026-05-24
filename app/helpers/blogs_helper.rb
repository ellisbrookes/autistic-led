module BlogsHelper
  def blog_preview_text(blog, length: 160)
    html = blog.content&.body&.to_html.to_s
    text_only = strip_tags(
      html
        .gsub(/<action-text-attachment[^>]*>.*?<\/action-text-attachment>/m, "")
        .gsub(/<figure[^>]*class="[^"]*attachment[^"]*"[^>]*>.*?<\/figure>/m, "")
    )

    truncate(text_only.squish, length: length)
  end
end
