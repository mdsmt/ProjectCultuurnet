guard 'coffeescript', :input => 'src/coffee', :output => 'js'

guard 'compass' do
  watch(Regexp.new('^src/scss/(.*)\.s[ac]ss'))
end

guard 'shell' do
  watch(Regexp.new('^src/coffee/(.*)\.coffee')) do |m|
    `coffee --join js/groundwork.all.js --compile src/coffee/plugins/*.coffee src/coffee/components/*.coffee`
  end
end
